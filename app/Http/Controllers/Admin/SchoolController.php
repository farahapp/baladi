<?php

namespace App\Http\Controllers\Admin;

use App\Models\Religion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReligionsRequest;
use App\Models\Admin_panel_setting;
use App\Models\Driving_school_status;
use App\Models\Employee;
use App\Models\Vechile_Information;
use App\Models\Vechile_Spare_Parts;
use App\Models\Vehicle_Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

use function Laravel\Prompts\alert;

class SchoolController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '1'), "id", "ASC", PC);
         
        $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.School.index', ['data' => $data,'other'=>$other]);
  
    }
    public function create()
    {
        return view("admin.School.create");
    }

    public function store(ReligionsRequest $request)
    {
        $com_code = auth()->user()->com_code;
        try {
            $checkExsists = get_cols_where_row(new Religion(), array("id"), array('com_code' => $com_code, 'name' => $request->name));

            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا  هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataTonInsert['name'] = $request->name;
            $DataTonInsert['active'] = $request->active;
            $DataTonInsert['added_by'] = auth()->user()->id;
            $DataTonInsert['com_code'] = $com_code;
            insert(new Religion(), $DataTonInsert);
            DB::commit();
            return redirect()->route('School.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Employee(), array("*"), array("com_code" => $com_code, "id" => $id));
        if (empty($data)) {
            return redirect()->route('School.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.School.edit", ['data' => $data]);
    }

    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Employee(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('School.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }

            $checkExsists = Employee::select("id")->where("com_code", "=", $com_code)->where("driver_name", "=", $request->driver_name)->where("id", "!=", $id)->first();
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['driver_school_start_date'] = $request->driver_school_start_date;
            $DataToUpdate['driver_school_start_road_training_date'] = $request->driver_school_start_road_training_date;
            $DataToUpdate['driver_school_road_exam_date'] = $request->driver_school_road_exam_date;
            $DataToUpdate['driver_school_road_re_exam_date'] = $request->driver_school_road_re_exam_date;
            $DataToUpdate['printing_licence_date'] = $request->printing_licence_date;
            $DataToUpdate['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
            if($request->has('sudanese_driving_license_Image')){
                $request->validate([
                    'sudanese_driving_license_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);
                $deletePath='assets/admin/uploads/'.$data->sudanese_driving_license_Image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                $the_file_path=uploadImage('assets/admin/uploads',$request->sudanese_driving_license_Image);
                $DataToUpdate['sudanese_driving_license_Image']=$the_file_path;
            }

            if($request->has('qatary_driving_license_Image_image')){
                $request->validate([
                    'qatary_driving_license_Image_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);
                $deletePath='assets/admin/uploads/'.$data->qatary_driving_license_Image_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                $the_file_path=uploadImage('assets/admin/uploads',$request->qatary_driving_license_Image_image);
                $DataToUpdate['qatary_driving_license_Image_image']=$the_file_path;
            }

            $DataToUpdate['driver_school_notes'] = $request->driver_school_notes;


            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Employee(), $DataToUpdate, array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('School.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('School.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('School.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }




  /////////////////////////////////////////////////////////////////////////////

  public function ajax_update_driving_school_status(Request $request)
  {
      if ($request->ajax()) {
          try {
            $com_code = auth()->user()->com_code;
            $data_to_update['driving_school_status']=$request->driving_school_status;
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

public function ajax_update_driving_traning_range(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['driving_traning_range']=$request->driving_traning_range;
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

public function ajax_update_driver_school_notes(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['driver_school_notes']=$request->driver_school_notes;
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

public function ajax_search(Request $request)
    {
        if ($request->ajax()) {

            $search_by_text = $request->search_by_text;
            $driving_school_status_search = $request->driving_school_status_search;
            $Functional_status_search= $request->Functional_status_search;

            
            if ($search_by_text == '') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "driver_name";
                $operator1 = "LIKE";
                $value1 = "%{$search_by_text}%";
            }
            if ($Functional_status_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "Functional_status";
                $operator3 = "=";
                $value3 = $Functional_status_search;
            }
            if (isset($driving_school_status_search)&&($driving_school_status_search !=null)) {
                //هنا نعمل شرط دائم التحقق
                $field2 = "driving_school_status";
                // $operator2 = "IN";
                $value2 = $driving_school_status_search;

                $data = Employee::select("*")->where($field1, $operator1, $value1)->whereIn($field2,$value2)->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);

            } else {
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
                $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2,$operator2,$value2)->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);
            }
            $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
            return view('admin.School.ajax_search', ['data' => $data,'other'=>$other]);
            }
    }
    /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function print_School_search(Request $request)
    {
            $search_by_text = $request->search_by_text;
            $driving_school_status_search = $request->driving_school_status_search;
            $Functional_status_search= $request->Functional_status_search;
            
            if ($search_by_text == '') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "driver_name";
                $operator1 = "LIKE";
                $value1 = "%{$search_by_text}%";
            }
            if ($Functional_status_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "Functional_status";
                $operator3 = "=";
                $value3 = $Functional_status_search;
            }
            if (isset($driving_school_status_search)&&($driving_school_status_search !=null)) {
                //هنا نعمل شرط دائم التحقق
                $field2 = "driving_school_status";
                // $operator2 = "IN";
                $value2 = $driving_school_status_search;

                $data = Employee::select("*")->where($field1, $operator1, $value1)->whereIn($field2,$value2)->where($field3, $operator3, $value3)->orderby('id', 'ASC')->get();

            } else {
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
                $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2,$operator2,$value2)->where($field3, $operator3, $value3)->orderby('id', 'ASC')->get();
            }

            $com_code = auth()->user()->com_code;
            $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');

            $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));

            
            return view('admin.School.print_School_search', ['data' => $data,'other'=>$other,'systemData'=>$systemData]);
            
    }
    /////////////////////////////////////////////////////////////////////////////





}
