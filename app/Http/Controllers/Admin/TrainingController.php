<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branche;
use App\Models\Departement;
use App\Models\jobs_categorie;
use App\Models\Qualification;
use App\Models\Religion;
use App\Models\Countries;
use App\Models\Nationalitie;
use App\Models\governorates;
use App\Models\centers;
use App\Models\blood_groups;
use App\Models\Driving_school_status;
use App\Models\driving_license_type;
use App\Models\Language;
use App\Models\Shifts_type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TrainingController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '1'), "id", "ASC", PC);
        return view("admin.Training.index", ['data' => $data]);
    }
    public function create()
    {
        $com_code = auth()->user()->com_code;
        $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['departements'] = get_cols_where(new Departement(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['jobs'] = get_cols_where(new jobs_categorie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['qualifications'] = get_cols_where(new Qualification(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['religions'] = get_cols_where(new Religion(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['nationalities'] = get_cols_where(new Nationalitie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['countires'] = get_cols_where(new Countries(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['blood_groups'] = get_cols_where(new blood_groups(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driving_license_types'] = get_cols_where(new driving_license_type(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['shifts_types'] = get_cols_where(new Shifts_type(), array("id", "type","from_time","to_time","total_hour"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['languages'] = get_cols_where(new Language(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');

        return view("admin.Training.create", ['other' => $other]);
    }

    public function store(Request $request)
    {
        
    }

    public function edit($driver_id){
        //$dd=Route::currentRouteName();
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Employee(), array("*"), array("id" => $driver_id, 'com_code' => $com_code));
        if (empty($data)) {
        return redirect()->route('Training.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة'.$driver_id]);
        }
        $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.Training.edit', ['data' => $data,'other'=>$other]);
    }



    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Training.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }


            DB::beginTransaction();

            $dataToUpdate['driving_school_status'] = $request->driving_school_status;
            
                // $dataToUpdate['driving_permit_number'] = $request->driving_permit_number;


                if($request->has('qatary_driving_license_Image_image')){
                    $request->validate([
                        'qatary_driving_license_Image_image'=>'required|mimes:png,jpg,jpeg|max:2000',
                    ]);
                    $deletePath='assets/admin/uploads/'.$data->qatary_driving_license_Image_image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }
                    $the_file_path=uploadImage('assets/admin/uploads',$request->qatary_driving_license_Image_image);
                    $dataToUpdate['qatary_driving_license_Image_image']=$the_file_path;
                }
        

            $dataToUpdate['english_lectures_atendence_range'] = $request->english_lectures_atendence_range;
            $dataToUpdate['english_lectures_understand_range'] = $request->english_lectures_understand_range;
            $dataToUpdate['talabat_lectures_atendence_range'] = $request->talabat_lectures_atendence_range;
            $dataToUpdate['talabat_lectures_understand_range'] = $request->talabat_lectures_understand_range;
            $dataToUpdate['atucate_lectures_atendence_range'] = $request->atucate_lectures_atendence_range;
            $dataToUpdate['atucate_lectures_understand_range'] = $request->atucate_lectures_understand_range;
            $dataToUpdate['driving_traning_range'] = $request->driving_traning_range;
            $dataToUpdate['driving_in_doha_traning_range'] = $request->driving_in_doha_traning_range;

            
           

            update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Training.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
    
    public function leactures()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Training.index", ['data' => $data]);
    }


    public function get_governorates(Request $request)
    {
        if ($request->ajax()) {
            $country_id = $request->country_id;
            $other['governorates'] = get_cols_where(new governorates(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'countires_id' => $country_id));
            return view('admin.Training.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.Training.get_centers',['other'=>$other]);
        }
    }

    
    /////////////////////////////////////////////////////////////////////////////

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $searchbyradio = $request->searchbyradio;
            $search_by_text = $request->search_by_text;
            $english_group_Search = $request->english_group_Search;
            $english_lectures_atendence_range_Search = $request->english_lectures_atendence_range_Search;
            $english_lectures_understand_range_Search = $request->english_lectures_understand_range_Search;
            $talabat_lectures_atendence_range_Search = $request->talabat_lectures_atendence_range_Search;
            $talabat_lectures_understand_range_Search = $request->talabat_lectures_understand_range_Search;
            $atucate_lectures_atendence_range_Search = $request->atucate_lectures_atendence_range_Search;
            $atucate_lectures_understand_range_Search = $request->atucate_lectures_understand_range_Search;

            if ($english_group_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "english_group";
                $operator1 = "=";
                $value1 = $english_group_Search;
            }
            if ($english_lectures_atendence_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "english_lectures_atendence_range";
                $operator2 = "=";
                $value2 = $english_lectures_atendence_range_Search;
            }
            if ($english_lectures_understand_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "english_lectures_understand_range";
                $operator3 = "=";
                $value3 = $english_lectures_understand_range_Search;
            }
            if ($talabat_lectures_atendence_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field4 = "id";
                $operator4 = ">";
                $value4 = 0;
            } else {
                $field4 = "talabat_lectures_atendence_range";
                $operator4 = "=";
                $value4 = $talabat_lectures_atendence_range_Search;
            }
            if ($talabat_lectures_understand_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field5 = "id";
                $operator5 = ">";
                $value5 = 0;
            } else {
                $field5 = "talabat_lectures_understand_range";
                $operator5 = "=";
                $value5 = $talabat_lectures_understand_range_Search;
            }
            if ($atucate_lectures_atendence_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field6 = "id";
                $operator6 = ">";
                $value6 = 0;
            } else {
                $field6 = "atucate_lectures_atendence_range";
                $operator6 = "=";
                $value6 = $atucate_lectures_atendence_range_Search;
            }
            if ($atucate_lectures_understand_range_Search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field7 = "id";
                $operator7 = ">";
                $value7 = 0;
            } else {
                $field7 = "atucate_lectures_understand_range";
                $operator7 = "=";
                $value7 = $atucate_lectures_understand_range_Search;
            }
            if ($search_by_text != '') {
                if($searchbyradio == 'name'){
                    $field8 = "driver_name";
                    $operator8 = "like";
                    $value8 = "%{$search_by_text}%";
                }elseif($searchbyradio == 'id_number'){
                    $field8 = "driver_residency_permit_id";
                    $operator8 = "like";
                    $value8 = "%{$search_by_text}%";
                }else{
                    $field8 = "driver_quater_tel";
                    $operator8 = "like";
                    $value8 = "%{$search_by_text}%";
                }
            }else{
                $field8 = "id";
                $operator8 = ">";
                $value8 = 0;
            }
            $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->where($field7, $operator7, $value7)->where($field8, $operator8, $value8)->where("Functional_status","=",'1')->orderby('id', 'ASC')->paginate(PC);
            return view('admin.Training.ajax_search', ['data' => $data]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

public function ajax_update_english_group(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['english_group']=$request->english_group;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_english_lectures_atendence_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['english_lectures_atendence_range']=$request->english_lectures_atendence_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_english_lectures_understand_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['english_lectures_understand_range']=$request->english_lectures_understand_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_talabat_lectures_atendence_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['talabat_lectures_atendence_range']=$request->talabat_lectures_atendence_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_talabat_lectures_understand_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['talabat_lectures_understand_range']=$request->talabat_lectures_understand_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_atucate_lectures_atendence_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['atucate_lectures_atendence_range']=$request->atucate_lectures_atendence_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_atucate_lectures_understand_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['atucate_lectures_understand_range']=$request->atucate_lectures_understand_range;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new Employee(),$data_to_update, array("com_code" => $com_code,'id' => $request->driver_id_value));
            DB::commit();
            echo json_encode("done");  
        } catch (\Exception $ex) {
            DB::rollBack();
            echo json_encode("error");  
        }
    }    
}
/////////////////////////////////////////////////////////////////////////////

}
