<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\permission_sub_menuesRequst;
use App\Models\Permission_main_menues;
use App\Models\Permission_sub_menues;
use App\Models\Permission_sub_menues_actions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionSubMenuesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data = get_cols_where_p(new Permission_sub_menues(), array("*"), array("com_code" => $com_code), 'id', 'ASC', PC);
        $dataSub_menueAction = get_cols_where(new Permission_sub_menues_actions(), array("*"), array("com_code" => $com_code));
        return view('admin.Permission_sub_menues.index', ['data' => $data, 'Permission_main_menuesData' => $Permission_main_menuesData,'dataSub_menueAction'=>$dataSub_menueAction]);
    }

    public function create()
    {
        $com_code = auth()->user()->com_code;
        $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $com_code = auth()->user()->com_code;
        return view('admin.Permission_sub_menues.create', ['data' => $data]);
    }

    public function store(permission_sub_menuesRequst $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Permission_sub_menues(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = $request->active;
            $DataToInsert['permission_main_menues_id'] = $request->permission_main_menues_id;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Permission_sub_menues(), $DataToInsert);
            DB::commit();
            return redirect()->route('permission_sub_menues.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {

        $com_code = auth()->user()->com_code;
        $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data['Permission_sub_menuesData'] = get_cols_where_row(new Permission_sub_menues(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('permission_sub_menues.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Permission_sub_menues.edit', ['data' => $data]);
    }

    public function update($id, permission_sub_menuesRequst $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_sub_menues(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_sub_menues.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Permission_sub_menues::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToInsert['permission_main_menues_id'] = $request->permission_main_menues_id;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Permission_sub_menues(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('permission_sub_menues.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }


    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $search_by_text = $request->search_by_text;
            $permission_main_menues_id_search = $request->permission_main_menues_id_search;
            
            if ($search_by_text == '') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "name";
                $operator1 = "LIKE";
                $value1 = "%{$search_by_text}%";
            }
            if ($permission_main_menues_id_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "permission_main_menues_id";
                $operator2 = "=";
                $value2 = $permission_main_menues_id_search;
            }
            $data = Permission_sub_menues::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->orderby('id', 'ASC')->paginate(PC);
            $dataSub_menueAction = get_cols_where(new Permission_sub_menues_actions(), array("*"), array("com_code" => $com_code));
            return view('admin.Permission_sub_menues.ajax_search', ['data' => $data,'dataSub_menueAction'=>$dataSub_menueAction]);
        }
    }
    public function ajax_do_add_permission(Request $request){
        if ($request->ajax()) {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Permission_sub_menues_actions(), array("id"), array("com_code" => $com_code,'name' => $request->name,'permission_sub_menues_id' => $request->permission_sub_menues_id));
            if (!empty($CheckExsists)) {
                echo json_encode("found");
              //  return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }else{
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = 1;
            $DataToInsert['permission_sub_menues_id'] = $request->permission_sub_menues_id;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Permission_sub_menues_actions(), $DataToInsert);
            DB::commit();
            echo json_encode("done");
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////
    public function ajax_load_edit_permission(Request $request){
        if ($request->ajax()) {

            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_sub_menues_actions(), array("id",'name'), array("com_code" => $com_code,'id' => $request->id));
            return view('admin.Permission_sub_menues.ajax_load_edit_permission',['data'=>$data]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////

    public function ajax_do_edit_permission(Request $request){
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $data_to_update['id']=$request->id;
            $data_to_update['name']=$request->name;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data = update(new Permission_sub_menues_actions(),$data_to_update, array("com_code" => $com_code,'id' => $request->id));
            return json_encode("done");
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_sub_menues(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_sub_menues.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Permission_sub_menues(), array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('permission_sub_menues.index')->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
/////////////////////////////////////////////////////////////////////////////

    public function ajax_do_delete_permission(Request $request)
    {
        if ($request->ajax()) {
            /*
            $com_code = auth()->user()->com_code;
             $data = get_cols_where_row(new Permission_sub_menues_actions(), array("id"), array('com_code' => $com_code,'id' => $request->id));
             if (empty($data)) {
                 echo json_encode("found");
             }else{
            DB::beginTransaction();
            destroy(new Permission_sub_menues_actions(), array('com_code' => $com_code, 'id' => $$request->id));
            DB::commit();
            echo json_encode($com_code);  
            }  
            */
            try {
                $com_code = auth()->user()->com_code;
                $data = get_cols_where_row(new Permission_sub_menues_actions(), array("*"), array('com_code' => $com_code, 'id' => $request->id));
                if (empty($data)) {
                    echo json_encode("found");  
                }
                DB::beginTransaction();
                destroy(new Permission_sub_menues_actions(), array('com_code' => $com_code, 'id' => $request->id));
                DB::commit();
                echo json_encode("done");  
            } catch (\Exception $ex) {
                DB::rollBack();
                echo json_encode("error");  
            }
        }    
    }
}
