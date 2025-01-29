<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function index(){
        $data=get_cols_where_row(new Admin(),array("*"),array("id"=>auth()->user()->id,'com_code'=>auth()->user()->com_code));
        return view('admin.user_profile.index',['data'=>$data]);
    }

    public function edit()
{

    $com_code = auth()->user()->com_code;
    $user_id = auth()->user()->id;
    $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $user_id));

    return view('admin.user_profile.edit', ['data' => $data]);
}

public function update(UserProfileRequest $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $userId = auth()->user()->id;
        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $userId));
        if (empty($data)) {
            return redirect()->route('userProfile.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }

        $CheckExsists_name = Admin::where(["username" => $request->username,'com_code'=>$com_code])->where('id','!=',$userId)->first();
        if (!empty($CheckExsists_name)) {
            return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
        }

        $CheckExsists_email = Admin::where(["email" => $request->email,'com_code'=>$com_code])->where('id','!=',$userId)->first();
        if (!empty($CheckExsists_email)) {
            return redirect()->back()->with(['error' => 'عفوا هذا البريد الالكتروني مسجل من قبل '])->withInput();
        }

        DB::beginTransaction();
        $DataToUpdate['email'] = $request->email;
        $DataToUpdate['username'] = $request->username;
        if($request->checkForUpdatePassword==1)
        {
        $DataToUpdate['password'] = bcrypt($request->password);
        }
        $DataToUpdate['updated_by'] = auth()->user()->id;
        update(new Admin(), $DataToUpdate, array("com_code" => $com_code, 'id' => $userId));
        DB::commit();
        return redirect()->route('userProfile.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}
}

