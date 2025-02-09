<?php

namespace App\Traits;

use Exception;
use Google\Auth\ApplicationDefaultCredentials;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait PushNotification {
   public function sendNotification($token,$title,$body,$data =[])
   {
        $fcmurl="https://fcm.googleapis.com/v1/projects/baladi-d7b5a/messages:send";
        $notification = [
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data,
            'token' => $token,
        ];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'content-Type' => 'application/json',
            ])->post($fcmurl,['message' => $notification]);
            return $response->json();
        } catch (Exception $e) {
            Log::error("Error sending push notification to token: ".$e->getMessage());
            return false;
        }
   }

   private function getAccessToken()
   {
    $keyPath = config('services.firebase.key_path');
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$keyPath);
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $credentials=ApplicationDefaultCredentials::getCredentials($scopes);
    $token =$credentials->fetchAuthToken();
    return $token['access_token'] ?? null ;

   }
}