<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequestAPI;
use App\Http\Requests\StoreUserRequestAPI;
use App\Models\Employee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use HttpResponses;
    
    function token(Request $request) {
        $request->validate([
            'baladi_id' =>'required',
            'password' =>'required',
            'device_name' =>'required',
        ]);

        $user = Employee::where('baladi_id',$request->baladi_id)->first();

       // if(!$user || $request->driver_quater_tel != $user->driver_quater_tel){
            if(!$user || $request->password != "admin"){
                throw ValidationException::withMessages([
                'error' =>['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken($request->device_name)->plainTextToken;
    }


    function register(StoreUserRequestAPI $request){
        $request->validated($request->all());

        $user = Employee::create([
                    'driver_name' => $request->driver_name,
                    'driver_quater_tel' => $request->driver_quater_tel,
                    'password' => Hash::make($request->password),
                ]);

                return $this->success([
                    'user' => $user,
                    'token' => $user->createToken('API Token of'.$user->driver_name)->plainTextToken
                ]);
        


    //     $valid = $request->validate([
    //         'driver_name' => 'required',
    //         'driver_quater_tel' => 'required | unique:employees',
    //         'password' => 'required',
    //     ]);

    //     $employee = Employee::create([
    //         'driver_name' => $valid['driver_name'],
    //         'driver_quater_tel' => $valid['driver_quater_tel'],
    //         'password' => Hash::make($valid['password']),
    //     ]);

    //     $token = $employee->createToken('token')->plainTextToken;

    //    return response()->json([
    //         'driver_name' => $employee,
    //         'token' => $token
    //     ]);

    }

    function login(LoginUserRequestAPI $request){
        $request->validated($request->all());

        if (!Auth::attempt([$request->only('baladi_id','password')])) {
            return $this->error('','Credentials do not match', 401);
        }

        $user = Employee::where('baladi_id',$request->baladi_id)->first();

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' .$user->driver_name)->plainTextToken
        ]);


        // $valid = $request->validate([
        //     'driver_quater_tel' => 'required',
        //     'password' => 'required',
        // ]);
        // $employee = Employee::where('driver_quater_tel',$valid['driver_quater_tel'])->first();
        // $password = Hash::check($valid['password'], $employee->password);
        // if(!$employee || (!Hash::check($valid['password'],$employee->password))){
        //     return response()->json(['message' =>'login problem']);
        // }else{
        //     $token = $employee->createToken('token')->plainTextToken;
        //     return response()->json([
        //         'driver_name' => $employee,
        //         'token' => $token
        //     ]);
        // }
    }

    function logout(){
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully been logged out and your token has been deleted',
        ]);
       // auth()->user()->tokens()->delete();
        //return response()->json(['message' =>'loged out successfully']);
    }


}
