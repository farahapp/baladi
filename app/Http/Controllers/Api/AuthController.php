<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequestAPI;
use App\Http\Requests\StoreUserRequestAPI;
use App\Models\Deposit;
use App\Models\DriversDeposit;
use App\Models\Employee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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

        if (!Auth::attempt([$request->only('driver_residency_permit_id','password')])) {
            return $this->error('','Credentials do not match', 401);
        }

        $user = Employee::where('driver_residency_permit_id',$request->driver_residency_permit_id)->first();

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





    //login get return token with user data
    public function loginWithToken(Request $request){
        $validated =Validator::make($request->all(),[
            'baladi_id'=>'required|string|max:255',
            'password'=>'required|string',
        ]);
        if($validated->fails()){
            return response()->json($validated->errors(),403);
        }

        $credentials =['baladi_id' =>$request->baladi_id ,'password'=>$request->PASSWORD_BCRYPT];
        try {
            // if(!auth()->attempt($credentials)){
            //     return response()->json(['error'=> 'invalid credentials'],403);
            // }
            $user = Employee::where('baladi_id',$request->baladi_id)->first();
            $deposit = DriversDeposit::where('driver_id',$user->id)->where("report_status",'0')->get();

            


       // if(!$user || $request->driver_quater_tel != $user->driver_quater_tel){
        if(!$user || $request->password != "admin"){
            throw ValidationException::withMessages([
            'error' =>['The provided credentials are incorrect.'],
        ]);
    }


            // $user =Employee::where('baladi_id',$request->baladi_id)->firstOrFail();

             $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['access_token'=> $token,
                                    'deposit'=>$deposit,
                                    'user'=>$user],200);


        }catch(\Exception $exception) {
            return response()->json(['error'=> $exception->getMessage()],403);
        }

    }
}
