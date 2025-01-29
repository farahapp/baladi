<?php
//لاتنسونا من صالح الدعاء وجزاكم الله خيرا
//أخي الكريم هذا الكود هو اول 100 ساعة بالكورس الي نهاية الدورة الفيدو رقم  190- اما باقي أكواد الدورة الثانية للتطوير النظام موجوده بالدورة ولابد ان تكتبها بنفسك لأهميتها وللإستفادة
//حجم الدورة المتوقع هو 350 ساعة  - الاشتراك بكورس يودمي له مميزات الحصول علي كود الدورة الاولي الي الفيدو 351 لأول 190 ساعه بالدورة
//تبدأ الدورة الثانية للتطوير من الفيدو 351 وهي متاحه علي الانتساب او كورس يودمي
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Admin_permission_to_employees;
use App\Models\Admin_permission_to_jobs_categorie;
use App\Models\Departement;
use App\Models\Employee;
use App\Models\jobs_categorie;
use App\Models\Permission_rols;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
public function index()
{
$com_code = auth()->user()->com_code;
$data = get_cols_where_p(new Admin(), array("*"), array("com_code" => $com_code),'id', 'DESC', PC);

$Permission_rols = get_cols_where(new Permission_rols(), array("id", "name"), array("com_code" => $com_code, "active" => 1));

return view('admin.admins_accounts.index', ['data' => $data,'Permission_rols'=>$Permission_rols]);
}

//==================================================================================

public function create()
{
    $com_code = auth()->user()->com_code;
    $Permission_rols = get_cols_where(new Permission_rols(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
    return view('admin.admins_accounts.create', ['Permission_rols' => $Permission_rols]);
}

public function store(AdminRequest $request)
{
    try {

        $com_code = auth()->user()->com_code;
        $CheckExsists = get_cols_where_row(new Admin(), array("id"), array("com_code" => $com_code, 'username' => $request->username));
        if (!empty($CheckExsists)) {
            return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
        }

        $Checkemail = get_cols_where_row(new Admin(), array("id"), array("com_code" => $com_code, 'email' => $request->email));
        if (!empty($Checkemail)) {
            return redirect()->back()->with(['error' => 'عفوا البريد الالكتروني مسجل من قبل '])->withInput();
        }


        DB::beginTransaction();
        $DataToInsert['name'] = $request->name;
        $DataToInsert['email'] = $request->email;
        $DataToInsert['username'] = $request->username;
        $DataToInsert['password'] = bcrypt($request->password);
        $DataToInsert['permission_roles_id'] = $request->permission_roles_id;
        $DataToInsert['does_has_ateendance'] = $request->does_has_ateendance;
        if($request->does_has_ateendance==1)
        {
        $DataToInsert['ateendance_device_no'] = $request->ateendance_device_no;
        }
        $DataToInsert['added_by'] = auth()->user()->id;
        $DataToInsert['com_code'] = $com_code;
        $DataToInsert['active'] = $request->active;
        insert(new Admin(), $DataToInsert);
        DB::commit();
        return redirect()->route('admins_accounts.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

public function edit($id)
{

    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $id));
    $Permission_rols = get_cols_where(new Permission_rols(), array("id", "name"), array("com_code" => $com_code, "active" => 1));

    if (empty($data)) {
        return redirect()->route('permission_sub_menues.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
    }

    return view('admin.admins_accounts.edit', ['data' => $data,'Permission_rols'=>$Permission_rols]);
}

public function update($id, AdminUpdateRequest $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('admins_accounts.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }

        $CheckExsists_name = Admin::where(["username" => $request->username,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if (!empty($CheckExsists_name)) {
            return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
        }

        $CheckExsists_email = Admin::where(["email" => $request->email,'com_code'=>$com_code])->where('id','!=',$id)->first();
        if (!empty($CheckExsists_email)) {
            return redirect()->back()->with(['error' => 'عفوا هذا البريد الالكتروني مسجل من قبل '])->withInput();
        }

        DB::beginTransaction();
        $DataToUpdate['name'] = $request->name;
        $DataToUpdate['email'] = $request->email;
        $DataToUpdate['username'] = $request->username;
        if($request->checkForUpdatePassword==1)
        {
        $DataToUpdate['password'] = bcrypt($request->password);
        }
        $DataToUpdate['permission_roles_id'] = $request->permission_roles_id;
        $DataToUpdate['does_has_ateendance'] = $request->does_has_ateendance;
        if($request->does_has_ateendance==1)
        {
        $DataToUpdate['ateendance_device_no'] = $request->ateendance_device_no;
        }
        $DataToUpdate['active'] = $request->active;        
        $DataToUpdate['updated_by'] = auth()->user()->id;
        update(new Admin(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
        DB::commit();
        return redirect()->route('admins_accounts.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
                $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $id));
                if (empty($data)) {
                    return redirect()->route('admins_accounts.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
                }else{
                    $employees=get_cols_where(new Departement(),array("id","name"),array("com_code"=>$com_code,"active"=>1));
                    if (empty($employees)) {
                        return redirect()->route('admins_accounts.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
                    }else{
                $admin_permission_to_employees=get_cols_where(new Admin_permission_to_employees(),array("*"),array("com_code"=>$com_code,"admin_id"=>$id));

                $jobs_categories = get_cols_where(new jobs_categorie(), array("*"), array("com_code" => $com_code));
                $Admin_permission_to_jobs_categorie=get_cols_where(new Admin_permission_to_jobs_categorie(),array("*"),array("com_code"=>$com_code,"admin_id"=>$id));

                return view('admin.admins_accounts.details', ['data' => $data,'employees'=>$employees,'jobs_categories'=>$jobs_categories,'admin_permission_to_employees'=>$admin_permission_to_employees,'Admin_permission_to_jobs_categorie'=>$Admin_permission_to_jobs_categorie]);
                }
            }
        }
        }
//===========================================================
public function ajax_search(Request $request)
{
    if ($request->ajax()) {
        $com_code = auth()->user()->com_code;
        $search_by_name = $request->search_by_name;
        $permission_roles_id = $request->permission_roles_id;
        
        if ($search_by_name == '') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "name";
            $operator1 = "LIKE";
            $value1 = "%{$search_by_name}%";
        }
        if ($permission_roles_id == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "permission_roles_id";
            $operator2 = "=";
            $value2 = $permission_roles_id;
        }
        $data = Admin::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->orderby('id', 'DESC')->paginate(PC);
        $Permission_rols = get_cols_where(new Permission_rols(), array("id", "name"), array("com_code" => $com_code, "active" => 1));

        return view('admin.admins_accounts.ajax_search', ['data' => $data,'Permission_rols'=>$Permission_rols]);
    }
}

//===========================================================
public function add_employees($id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }else{

        $employees_ids=$request->employees_ids;
        if(empty($employees_ids)){
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        foreach($employees_ids as $info){
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['admin_id']=$id;
            $DataToInsert['employees_id']=$info;
            $CheckExsists=get_cols_where_row(new Admin_permission_to_employees(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['date'] = date("Y-m-d");
            $DataToInsert['active'] = 1;
            insert(new Admin_permission_to_employees(), $DataToInsert);
            DB::commit();
        }          
    }
    return redirect()->route('admins_accounts.details',$id)->with(['success' => 'تم اضافة البيانات بنجاح']);

        }
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}
// =========================================================================
 // =========================================================================
 public function destroy_admin_permission_to_employees($id)
 {
     try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin_permission_to_employees(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }

         DB::beginTransaction();
         destroy(new Admin_permission_to_employees(), array('com_code' => $com_code, 'id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================
 // =========================================================================
 public function destroy_admin_permission_to_jobs_categories($id)
 {
     try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin_permission_to_jobs_categorie(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }

         DB::beginTransaction();
         destroy(new Admin_permission_to_jobs_categorie(), array('com_code' => $com_code, 'id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================


//===========================================================
public function add_jobs_categories($id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Admin(), array("*"), array("com_code" => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }else{

        $jobs_categories_ids=$request->jobs_categories_ids;
        if(empty($jobs_categories_ids)){
            return redirect()->route('admins_accounts.details',$id)->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        foreach($jobs_categories_ids as $info){
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['admin_id']=$id;
            $DataToInsert['jobs_categories_id']=$info;
            $CheckExsists=get_cols_where_row(new Admin_permission_to_jobs_categorie(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['date'] = date("Y-m-d");
            $DataToInsert['active'] = 1;
            insert(new Admin_permission_to_jobs_categorie(), $DataToInsert);
            DB::commit();
        }          
    }
    return redirect()->route('admins_accounts.details',$id)->with(['success' => 'تم اضافة البيانات بنجاح']);

        }
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}
// =========================================================================

 
}
