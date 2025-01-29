<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission_main_menuesRequst;
use App\Models\Permission_main_menues;
use App\Models\Permission_sub_menues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionMainMenuesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Permission_main_menues(), array("*"), array("com_code" => $com_code), 'id', 'ASC', PC);
        return view('admin.Permission_main_menues.index', ['data' => $data]);
    }
    
    public function create()
    {
        $com_code = auth()->user()->com_code;
        return view('admin.Permission_main_menues.create');
    }

    public function store(Permission_main_menuesRequst $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Permission_main_menues(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = $request->active;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Permission_main_menues(), $DataToInsert);
            DB::commit();
            return redirect()->route('permission_main_menues.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {

        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Permission_main_menues(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('permission_main_menues.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Permission_main_menues.edit', ['data' => $data]);
    }

    public function update($id, Permission_main_menuesRequst $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_main_menues(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_main_menues.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Permission_main_menues::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Permission_main_menues(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('permission_main_menues.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }
    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_main_menues(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_main_menues.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Permission_main_menues(), array('com_code' => $com_code, 'id' => $id));
            //destroy(new Permission_sub_menues(), array('com_code' => $com_code, 'permission_main_menues_id' => $id));
            DB::commit();
            return redirect()->route('permission_main_menues.index')->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
}
