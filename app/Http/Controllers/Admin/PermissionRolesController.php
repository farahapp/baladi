<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission_rolesRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Permission_main_menues;
use App\Models\Permission_roles_main_menus;
use App\Models\Permission_roles_sub_menu;
use App\Models\Permission_roles_sub_menues_actions;
use App\Models\Permission_rols;
use App\Models\Permission_sub_menues;
use App\Models\Permission_sub_menues_actions;
use Illuminate\Support\Facades\DB;

class PermissionRolesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Permission_rols(), array("*"), array("com_code" => $com_code), 'id', 'ASC', PC);
        return view('admin.Permission_roles.index', ['data' => $data]);
    }

    

    public function create()
    {
        $com_code = auth()->user()->com_code;
        return view('admin.Permission_roles.create');
    }

    public function store(Permission_rolesRequest $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Permission_rols(), array("id"), array("com_code" => $com_code, 'name' => $request->name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = $request->active;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Permission_rols(), $DataToInsert);
            DB::commit();
            return redirect()->route('permission_roles.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {

        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Permission_rols(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('permission_roles.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Permission_roles.edit', ['data' => $data]);
    }

    public function update($id, Permission_rolesRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_rols(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_roles.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Permission_rols::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Permission_rols(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('permission_roles.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    //===============================================================================================================================
    public function details($id){
    {
       // try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_rols(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_roles.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }else{

          $Permission_main_menues=get_cols_where(new Permission_main_menues(),array("id",'name'),array("com_code" => $com_code,"active"=>1));
          $permission_roles_main_menues=get_cols_where(new Permission_roles_main_menus(),array("*"),array("com_code" => $com_code,"permission_roles_id"=>$id));
        
          $permission_roles_sub_menu=get_cols_where(new Permission_roles_sub_menu(),array("*"), array("permission_roles_id" => $id),'id', 'ASC', PC);
          $permission_roles_sub_menu_action=get_cols(new Permission_roles_sub_menues_actions(),array("*"));
         //==========================(طريقة قديمة ومتخلفة)==================================
        //   if(!empty($permission_roles_main_menues)){
        //     $permission_sub_menues_nameData="";
        //      foreach($permission_roles_main_menues as $info ){
        //         $info->permission_roles_sub_menu=get_cols_where(new Permission_roles_sub_menu(),array("*"),array("permission_roles_main_menus_id"=>$info->permission_main_menus_id));
        //         if(!empty($info->permission_roles_sub_menu)){
        //             foreach($info->permission_roles_sub_menu as $sub ){
        //                $permission_sub_menues_nameData=$info->permission_sub_menues_name=get_field_value(new Permission_sub_menues(),array("*"),array("permission_sub_menues_id"=>$sub->permission_sub_menues_id));

                        
        //             }
        //         }       
        //      }
        //   }
          //=======================================================================================
            return view('admin.Permission_roles.details', ['data' => $data,'Permission_main_menues'=>$Permission_main_menues,'permission_roles_main_menues'=>$permission_roles_main_menues,'permission_sub_menues_nameData'=>$permission_roles_sub_menu,'permission_roles_sub_menu_action'=>$permission_roles_sub_menu_action]);
            }
    }
    }
    
    public function Add_permission_main_menues($id,Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_rols(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('permission_roles.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $permission_main_menues_ids=$request->permission_main_menues_id;
            if(empty($permission_main_menues_ids)){
                return redirect()->route('permission_roles.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            foreach($permission_main_menues_ids as $info){
                $DataToInsert['com_code'] = $com_code;
                $DataToInsert['permission_roles_id']=$id;
                $DataToInsert['permission_main_menues_id']=$info;
                $CheckExsists=get_cols_where_row(new Permission_roles_main_menus(),array("id"),$DataToInsert);
            if (empty($CheckExsists)) {
                DB::beginTransaction();
                $DataToInsert['added_by'] = auth()->user()->id;
                insert(new Permission_roles_main_menus(), $DataToInsert);
                DB::commit();
            }   
            }return redirect()->route('permission_roles.details',$id)->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }
    // =========================================================================
    public function delete_permission_main_menues($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_roles_main_menus(), array("id"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Permission_roles_main_menus(), array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
    // ====================================================================
    public function load_add_permission_roles_sub_menu(Request $request){
        if($request->ajax()){
            $com_code=auth()->user()->com_code;
            $permission_roles_main_menus=get_cols_where_row(new Permission_roles_main_menus(),array("id","permission_main_menues_id"),array("id"=>$request->id,"com_code"=>$com_code));
            $permission_sub_menues="";

            if(!empty($permission_roles_main_menus)){
                $permission_sub_menues=get_cols_where(new Permission_sub_menues(),array("id","name"),array("com_code"=>$com_code,"permission_main_menues_id"=>$permission_roles_main_menus['permission_main_menues_id']),'id','ASC');
            }
           // echo $permission_roles_main_menus['permission_main_menues_id'];
            return view('admin.Permission_roles.load_add_permission_roles_sub_menu',['permission_roles_main_menus'=>$permission_roles_main_menus,'permission_sub_menues'=>$permission_sub_menues]);
      }
    }
// ==================================================================================
 
public function add_permission_roles_sub_menu($permission_roles_main_menus_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Permission_roles_main_menus(), array("*"), array("com_code" => $com_code, 'id' => $permission_roles_main_menus_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        $permission_sub_menues_id=$request->permission_sub_menues_id;
        if(empty($permission_sub_menues_id)){
            return redirect()->back()->with(['error' => 'من فضلك اختر القوائم أولا']);
        }
        foreach($permission_sub_menues_id as $info){
            $DataToInsert['permission_roles_main_menus_id']=$permission_roles_main_menus_id;
            $DataToInsert['permission_sub_menues_id']=$info;
            $DataToInsert['permission_roles_id']=$data['permission_roles_id'];            
            $CheckExsists=get_cols_where_row(new Permission_roles_sub_menu(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Permission_roles_sub_menu(), $DataToInsert);
            DB::commit();
        }   
        }return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================
 // =========================================================================
 public function delete_permission_sub_menues($id)
 {
     try {
         $com_code = auth()->user()->com_code;
         $data = get_cols_where_row(new Permission_roles_sub_menu(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new Permission_roles_sub_menu(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================
   // ====================================================================
   public function load_add_permission_roles_sub_menues_action(Request $request){
    if($request->ajax()){
        $com_code=auth()->user()->com_code;
        $permission_roles_sub_menu=get_cols_where_row(new Permission_roles_sub_menu(),array("*"),array("id"=>$request->id));
        $permission_sub_menues_actions="";

        if(!empty($permission_roles_sub_menu)){
            $permission_sub_menues_actions=get_cols_where(new Permission_sub_menues_actions(),array("id","name"),array("com_code"=>$com_code,"permission_sub_menues_id"=>$permission_roles_sub_menu['permission_sub_menues_id']),'id','ASC');
        }
       // echo $permission_roles_main_menus['permission_main_menues_id'];
        return view('admin.Permission_roles.load_add_permission_roles_sub_menues_action',['permission_roles_sub_menu'=>$permission_roles_sub_menu,'permission_sub_menues_actions'=>$permission_sub_menues_actions]);
  }
}
// ==================================================================================
// ==================================================================================
 
public function add_permission_roles_sub_menues_action($permission_roles_sub_menu_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Permission_roles_sub_menu(), array("*"), array('id' => $permission_roles_sub_menu_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        $permission_sub_menues_actions_id=$request->permission_sub_menues_actions_id;
        if(empty($permission_sub_menues_actions_id)){
            return redirect()->back()->with(['error' => 'من فضلك اختر القوائم أولا']);
        }
        foreach($permission_sub_menues_actions_id as $info){
            $DataToInsert['permission_roles_sub_menu_id']=$permission_roles_sub_menu_id;
            $DataToInsert['permission_sub_menues_actions_id']=$info;
            $DataToInsert['permission_roles_id']=$data['permission_roles_id'];
            $CheckExsists=get_cols_where_row(new Permission_roles_sub_menues_actions(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Permission_roles_sub_menues_actions(), $DataToInsert);
            DB::commit();
        }   
        }return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================
 // =========================================================================
 public function delete_permission_sub_menues_actions($id)
 {
     try {
         $data = get_cols_where_row(new Permission_roles_sub_menues_actions(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new Permission_roles_sub_menues_actions(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================



}
