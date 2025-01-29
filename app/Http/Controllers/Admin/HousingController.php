<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\flatDriverRequest;
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
use App\Models\Flat;
use App\Models\Language;
use App\Models\Shifts_type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HousingController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $flatData= get_cols_where(new Flat(), array("id", "flat_No","bulding_no"), array("com_code" => $com_code, "active" => 1),'bulding_no','ASC');
        $flatsunique = $flatData->unique('bulding_no');
        return view("admin.Housing.index", ['data' => $data,'flats'=>$flatData,'flatsunique'=>$flatsunique]);
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

        return view("admin.Housing.create", ['other' => $other]);
    }

    public function store(Request $request)
    {
     
    }


    

    public function update($id,flatDriverRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Housing.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            $dataToUpdate['appartment_no'] = $request->flats;
            $dataToUpdate['bulding_no'] = $request->bulding;
            $dataToUpdate['uniform_status'] = $request->uniform_status;
            update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Housing.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }


    public function employess()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Housing.index", ['data' => $data]);
    }

    public function flats()
    {
        
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Flat(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Housing.flats", ['data' => $data]);
    }

    public function flatscreate()
    {
        
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Flat(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Housing.flatscreate", ['data' => $data]);
    }

    public function flatstore(Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Flat(), array('id'), array("com_code" => $com_code, 'flat_No' => $request->flat_No));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا اسم الادارة مسجل من قبل !'])->withInput();
            }
            DB::beginTransaction();
            $dataToinsert['flat_No'] = $request->flat_No;
            $dataToinsert['bulding_no'] = $request->bulding_no;
            $dataToinsert['bed_number'] = $request->bed_number;
            $dataToinsert['electrical_counter_number'] = $request->electrical_counter_number;
            $dataToinsert['water_counter_number'] = $request->water_counter_number;
            if($request->has('flat_image')){
                $request->validate([
                    'flat_image'=>'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $the_file_path=uploadImage('assets/admin/uploads',$request->flat_image);
                $dataToUpdate['flat_image']=$the_file_path;
            }
            $dataToinsert['active'] = $request->active;
            $dataToinsert['added_by'] = auth()->user()->id;
            $dataToinsert['com_code'] = $com_code;
            insert(new Flat(), $dataToinsert);
            DB::commit();
            return  redirect()->route('Housing.flats')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('Housing.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
        }
        $flatData = Flat::select("id","bulding_no")->where("active","=", 1)->where("com_code","=", $com_code)->orderby('id', 'ASC')->paginate(PC);

        $other['flats'] = $flatData->unique('bulding_no');
        // $other['flats'] = get_cols_where(new Flat(), array("id","bulding_no"), array("active" => 1,"com_code" => $com_code),'id','ASC');


        return view('admin.Housing.edit', ['data' => $data,'other'=>$other]);
    }



    public function flatsedit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Flat(), array("*"), array('com_code' => $com_code, 'id' => $id));
        if (empty($data)) {
            return redirect()->route('Housing.flats')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
        }
        return view('admin.Housing.flatsedit', ['data' => $data]);
    }


    public function flatsupdate($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Flat(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Housing.flats')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }


            DB::beginTransaction();
            

            if($request->has('flat_image')){
                $request->validate([
                    'flat_image'=>'required|mimes:png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->flat_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->flat_image);
                $dataToUpdate['flat_image']=$the_file_path;
            }

            $dataToUpdate['flat_No'] = $request->flat_No;
            $dataToUpdate['bulding_no'] = $request->bulding_no;
            $dataToUpdate['bed_number'] = $request->bed_number;
            $dataToUpdate['electrical_counter_number'] = $request->electrical_counter_number;
            $dataToUpdate['water_counter_number'] = $request->water_counter_number;
            $dataToUpdate['driver_number'] = $request->driver_number;
            $dataToUpdate['flat_range'] = $request->flat_range;
           
            $dataToUpdate['active'] = $request->active;
            $dataToUpdate['updated_by'] = auth()->user()->id;
            $dataToUpdate['com_code'] = $com_code;

            update(new Flat(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Housing.flats')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function flatsdestroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Departement(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Housing.flats')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Departement(), array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Housing.flats')->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

   




    public function get_flats(Request $request)
    {
        if ($request->ajax()) {
            $bulding_no = $request->bulding_no;
            $old_flats_id= $request->old_flats_id;
            $other['flats'] = get_cols_where(new Flat(), array("id","bulding_no","flat_No"), array("active" => 1,"com_code" => auth()->user()->com_code,"bulding_no" => $bulding_no),'id','ASC');
            $other['old_flats_id']= $old_flats_id;
            return view('admin.Housing.get_flats',['other'=>$other]);
        }
    }

    /////////////////////////////////////////////////////////////////////////////

  public function ajax_update_flats(Request $request)
  {
      if ($request->ajax()) {
          try {
            $com_code = auth()->user()->com_code;
            $data_to_update['appartment_no']=$request->flats;
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

 public function ajax_update_uniform_status(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['uniform_status']=$request->uniform_status;
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




    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.Employees.get_centers',['other'=>$other]);
        }
    }


    /////////////////////////////////////////////////////////////////////////////
public function ajax_search(Request $request)
{
    if ($request->ajax()) {
        $search_by_text = $request->search_by_text;
        $bulding_search = $request->bulding_search;
        $flats_search = $request->flats_search;
        
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
        // if ($bulding_search == 'all') {
        //     //هنا نعمل شرط دائم التحقق
        //     $field2 = "id";
        //     $operator2 = ">";
        //     $value2 = 0;
        // } else {
        //     $field2 = "bulding_no";
        //     $operator2 = "=";
        //     $value2 = $flats_search;
        // }
        if ($flats_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "appartment_no";
            $operator3 = "=";
            $value3 = $flats_search;
        }

        $com_code = auth()->user()->com_code;
        //$getFlat_ID = Flat::select("id")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3);
       // $data = Employee::select("*")->where($field1, $operator1, $value1)->where("appartment_no", "=", 1)->orderby('id', 'DESC')->paginate(PC);

    //    $data =DB::table('employees')
    //             ->join('flats','employees.appartment_no','=','flats.id')
    //             ->where('employees.driver_name','LIKE',"%{$search_by_text}%")
    //             ->select('employees.*','flats.*');


        // $data = Employee::join('flats',function($join){
        //     $join->on('employees.appartment_no','flats.id');
        // });


         $data = Employee::select("*")->where($field1, $operator1,$value1)->where($field3, $operator3,$value3)->orderby('id', 'ASC')->paginate(PC);
         $flatData= get_cols_where(new Flat(), array("id", "flat_No","bulding_no"), array("com_code" => $com_code, "active" => 1),'bulding_no','ASC');
         $flatsunique = $flatData->unique('bulding_no');
       // $flats= get_cols_where(new Flat(), array("id", "flat_No","bulding_no"), array("com_code" => $com_code, "active" => 1));
        return view('admin.Housing.ajax_search', ['data' => $data,'flats'=>$flatData,'flatsunique'=>$flatsunique]);
        }
}
/////////////////////////////////////////////////////////////////////////////

}
