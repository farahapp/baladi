<?php

namespace App\Http\Controllers\Driver;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverLoginRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DriverLoginController extends Controller
{
    public function show_login_view()
    {
        return view('driver.auth.driver_login');
        /*
    $admin['name']="admin";
     $admin['email']="test@gmail.com";
     $admin['username']="admin";
     $admin['password']=bcrypt("admin");
     $admin['active']=1;
     $admin['date']=date("Y-m-d");
     $admin['com_code']=1;
     $admin['added_by']=1;
     $admin['updated_by']=1;
     Admin::create($admin);
*/

// DB::beginTransaction();
//      $driver['driver_email']="mojahid@gmail.com";
  
//      $driver['password']=bcrypt("admin");
     
//      $driver['updated_by']=1;
//      Employee::where('id',19)->update($driver);
//     DB::commit();


    }
    public function login(DriverLoginRequest $request)
    {
        if (auth()->guard('driver')->attempt(['driver_email' => $request->input('driver_email'), 'password' => $request->input('driver_password'),'active'=>1])) {
            return redirect()->route('driver.edit');
        } else {
            return redirect()->route('driver.showlogin',['locale'=>app()->getLocale()])->with(['error' => 'عفوا بيانات التسجيل غير صحيحة !!']);
        }
    }
    public function logout(){
      auth()->logout();
      return redirect()->route('driver.showlogin',['locale'=>app()->getLocale()]);  
    }
}
