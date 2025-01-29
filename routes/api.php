<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// Route::group(['namespace' => 'Api', 'prefix' => '/api', 'middleware' => ['guest:admin']], function () {
//     Route::post('register', [AuthController::class, 'register'])->name('api.register');
//     Route::post('login', [AuthController::class, 'login'])->name('api.login');
// });




//Public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


//zaaby
Route::post('/token',[AuthController::class,'token']);


//Protected routes
Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::post('/logout',[AuthController::class,'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user/revoke', function (Request $request) {
    $user = $request->user();
    $user->tokens()->delete();
    return 'tokens are deleted';
});
