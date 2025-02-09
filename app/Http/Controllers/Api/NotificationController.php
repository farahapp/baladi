<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequestAPI;
use App\Http\Requests\StoreUserRequestAPI;
use App\Models\Deposit;
use App\Models\DriversDeposit;
use App\Models\Employee;
use App\Models\Vechile_Traffic_Violations;
use App\Models\VehicleAccident;
use App\Traits\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class NotificationController extends Controller
{
    use PushNotification;
    
    public function sendPushNotification(Request $request)
    {
        $deviceToken = "eafgfgffgfhdf";
        $title = "Notification Title";
        $body = "Notification Body";

        $data = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];

        $reponse = $this->sendNotification($deviceToken,$title,$body,$data);

        return response()->json([
            'success' => true,
            'response'=>$reponse]);


    }
   






}
