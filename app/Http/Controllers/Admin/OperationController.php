<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\importDailyTalabatReportRequest;
use App\Http\Requests\importMonthlyTalabatReportRequest;
use App\Http\Requests\OperationRequest;
use App\Imports\AttendenceImport;
use App\Imports\DailyTalabatReportImport;
use App\Imports\MonthlyTalabatReportImport;
use App\Models\Admin_panel_setting;
use App\Models\Attendence;
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
use App\Models\Driver_bank_process;
use App\Models\Driving_school_status;
use App\Models\driving_license_type;
use App\Models\Language;
use App\Models\OperatingTalabatDailyReport;
use App\Models\OperatingTalabatMonthlyReport;
use App\Models\Residency_process_status;
use App\Models\Shifts_type;
use App\Models\Sponsorship_transfer_status;
use App\Models\Vechile_Information;
use App\Models\Vechile_Model;
use App\Models\Vechile_Traffic_Violations;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class OperationController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        // $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
       
       
        // $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '2'), "id", "ASC", PC);
        $other['vechile_information'] = get_cols_where(new Vechile_Information(), array("*"),  array("com_code" => $com_code),'id','ASC');
        $other['vechile_model'] = get_cols_where(new Vechile_Model(), array("*"),  array("com_code" => $com_code),'id','ASC');


        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '2'), "id", "ASC", PC);

        //dd($data);


        return view("admin.Operation.index",['data' => $data,'other'=>$other]);
    }
    public function create()
    {
        $com_code = auth()->user()->com_code;
        $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['departements'] = get_cols_where(new Departement(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['jobs'] = get_cols_where(new jobs_categorie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['qualifications'] = get_cols_where(new Qualification(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['religions'] = get_cols_where(new Religion(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['nationalities'] = get_cols_where(new Nationalitie(), array("id", "name"), array("com_code" => $com_code, "active" => 1),'id','ASC');
        $other['countires'] = get_cols_where(new Countries(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['blood_groups'] = get_cols_where(new blood_groups(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driving_license_types'] = get_cols_where(new driving_license_type(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['sponsorship_transfer_status'] = get_cols_where(new Sponsorship_transfer_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['shifts_types'] = get_cols_where(new Shifts_type(), array("id", "type","from_time","to_time","total_hour"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['languages'] = get_cols_where(new Language(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
        $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');
     

        return view("admin.Operation.create", ['other' => $other]);
    }

    public function store(OperationRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
           
            $CheckExsists = get_cols_where_row(new Employee(), array("id"), array("com_code" => $com_code,'driver_name' => $request->driver_name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }else{

            DB::beginTransaction();

            $DataToInsert['driver_name'] = $request->driver_name;
            $DataToInsert['driver_english_name'] = $request->driver_english_name;
            $DataToInsert['nationalities'] = $request->nationalities;
            $DataToInsert['job_type'] = $request->job_type;
            $DataToInsert['delevery_type'] = $request->delevery_type;
            $DataToInsert['appointment_type'] = $request->appointment_type;
            $dataToUpdate['branches'] = $request->branches;
            $DataToInsert['contract_type'] = $request->contract_type;
            $DataToInsert['isVisaPrinted'] = $request->isVisaPrinted;
            if($request->isVisaPrinted==1)
            {
                $DataToInsert['visa_number'] = $request->visa_number;
                $DataToInsert['visa_start_date'] = $request->visa_start_date;
                $DataToInsert['visa_end_date'] = $request->visa_end_date;
                // $DataToInsert['visa_image'] = $request->visa_image;
            }
            
            if($request->has('visa_image')){
                $request->validate([
                    'visa_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $the_file_path=uploadImage('assets/admin/uploads',$request->visa_image);
                $DataToInsert['visa_image']=$the_file_path;
            }


            $DataToInsert['driver_gender'] = $request->driver_gender;
            $DataToInsert['brith_date'] = $request->brith_date;
            $DataToInsert['marital_status'] = $request->marital_status;
            if($request->marital_status==1)
            {
            $DataToInsert['sons_number'] = $request->sons_number;
            }
            $DataToInsert['driver_pasport_no'] = $request->driver_pasport_no;
            $DataToInsert['driver_pasport_exp'] = $request->driver_pasport_exp;
           // $DataToInsert['driver_pasport_image'] = $request->driver_pasport_image;

            if($request->has('driver_pasport_image')){
                $request->validate([
                    'driver_pasport_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $the_file_path=uploadImage('assets/admin/uploads',$request->driver_pasport_image);
                $DataToInsert['driver_pasport_image']=$the_file_path;
            }

            $DataToInsert['Qualifications_id'] = $request->Qualifications_id;
            $DataToInsert['driver_sudan_tel'] = $request->driver_sudan_tel;
            $DataToInsert['sudan_driver_Basic_stay_address'] = $request->sudan_driver_Basic_stay_address;


            // $DataToInsert['isPostPayInSudan'] = $request->isPostPayInSudan;
            // if($request->isPostPayInSudan==1)
            // {
            //     $DataToInsert['post_pay_amount'] = $request->post_pay_amount;
            //   //  $DataToInsert['post_pay_pill_image'] = $request->post_pay_pill_image;
            // }

            // if($request->has('post_pay_pill_image')){
            //     $request->validate([
            //         'post_pay_pill_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
            //     ]);

            //     $the_file_path=uploadImage('assets/admin/uploads',$request->post_pay_pill_image);
            //     $DataToInsert['post_pay_pill_image']=$the_file_path;
            // }

            $DataToInsert['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
            if($request->does_has_sudanese_Driving_License==1)
            {
                $DataToInsert['sudanese_driving_License_number'] = $request->sudanese_driving_License_number;
                // $DataToInsert['sudanese_driving_license_types_id'] = $request->sudanese_driving_license_types_id;
             //   $DataToInsert['sudanese_driving_license_Image'] = $request->sudanese_driving_license_Image;
            }
            if($request->has('sudanese_driving_license_Image')){
                $request->validate([
                    'sudanese_driving_license_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $the_file_path=uploadImage('assets/admin/uploads',$request->sudanese_driving_license_Image);
                $DataToInsert['sudanese_driving_license_Image']=$the_file_path;
            }




               if($request->employer!=''||$request->employer!=null)
                {
                    $DataToInsert['employer'] = $request->employer;
                }

                if($request->has('no_objection_image')){
                    $request->validate([
                        'no_objection_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);
    
                    $the_file_path=uploadImage('assets/admin/uploads',$request->no_objection_image);
                    $DataToInsert['no_objection_image']=$the_file_path;
                }



                if($request->old_qid_number!=''||$request->old_qid_number!=null)
                {
                    $DataToInsert['old_qid_number'] = $request->old_qid_number;
                }

              
    



            if($request->has('old_qid_image')){
                $request->validate([
                    'old_qid_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $the_file_path=uploadImage('assets/admin/uploads',$request->old_qid_image);
                $DataToInsert['old_qid_image']=$the_file_path;
            }

            if($request->arrive_qater_date!=''||$request->arrive_qater_date!=null)
            {
                $DataToInsert['arrive_qater_date'] = $request->arrive_qater_date;
            }



            if($request->sponsorship_transfer_status!=''||$request->sponsorship_transfer_status!=null)
            {
                $DataToInsert['sponsorship_transfer_status'] = $request->sponsorship_transfer_status;
            }


            if($request->has('driver_photo')){
                $request->validate([
                    'driver_photo'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $the_file_path=uploadImage('assets/admin/uploads',$request->driver_photo);
                $DataToInsert['driver_photo']=$the_file_path;
            }


            /////////////////////////////////////////////////////////////////////////
            $DataToInsert['com_code'] = auth()->user()->com_code;        
            $DataToInsert['active'] = 1;        
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Employee(), $DataToInsert);
            DB::commit();
            return redirect()->route('Operation.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        }
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($driver_id){

        // URL::defaults(['locale'=>app()->getLocale()]);

        $com_code = auth()->user()->com_code;

            /////////////////////////////////////////////////////////////////////////


            $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['departements'] = get_cols_where(new Departement(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['jobs'] = get_cols_where(new jobs_categorie(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['qualifications'] = get_cols_where(new Qualification(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['religions'] = get_cols_where(new Religion(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['nationalities'] = get_cols_where(new Nationalitie(), array("id", "name"), array("com_code" => $com_code, "active" => 1),'id','ASC');
            $other['countires'] = get_cols_where(new Countries(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['blood_groups'] = get_cols_where(new blood_groups(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
            $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
            $other['driving_license_types'] = get_cols_where(new driving_license_type(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
            $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
            $other['sponsorship_transfer_status'] = get_cols_where(new Sponsorship_transfer_status(), array("id", "name"), array("active" => 1),'id','ASC');
            $other['shifts_types'] = get_cols_where(new Shifts_type(), array("id", "type","from_time","to_time","total_hour"), array("active" => 1,"com_code" => $com_code),'id','ASC');
            $other['languages'] = get_cols_where(new Language(), array("id", "name"), array("active" => 1,"com_code" => $com_code),'id','ASC');
            $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');
       

       /////////////////////////////////////////////////////////////////////////


        $data = get_cols_where_row(new Employee(), array("*"), array("id" => $driver_id, 'com_code' => $com_code));
        if (empty($data)) {
        return redirect()->route('Operation.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.Operation.edit', ['data' => $data,'other'=>$other]);

    }





 
        public function update($id, OperationRequest $request)
        {
            try {
                $com_code = auth()->user()->com_code;
                $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
                if (empty($data)) {
                    return redirect()->route('Operation.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة !']);
                }

                // $CheckExsists = Employee::select("id")->where('com_code', '=', $com_code)->where('driver_name', '=', $request->driver_name)->where('id', '!=', $id)->first();
                // if (!empty($CheckExsists)) {
                //     return redirect()->back()->with(['error' => 'عفوا اسم السائق مسجل من قبل !'])->withInput();
                // }


                DB::beginTransaction();

                $dataToUpdate['delevery_type'] = $request->delevery_type;
                $dataToUpdate['operating_contract_type'] = $request->operating_contract_type;
                $dataToUpdate['operating_company'] = $request->operating_company;
                if($request->operating_company==1)
                {
                    $dataToUpdate['operating_talabat_no'] = $request->operating_talabat_no;
                    $dataToUpdate['operating_talabat_rate'] = $request->operating_talabat_rate;
                }
                if($request->operating_company==2)
                {
                    $dataToUpdate['operating_snono_no'] = $request->operating_snono_no;
                }
                $dataToUpdate['operating_starting_work_date'] = $request->operating_starting_work_date;
                $dataToUpdate['operating_working_status'] = $request->operating_working_status;
            

                
                $dataToUpdate['updated_by'] = auth()->user()->id;
                update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
                DB::commit();
                return redirect()->route('Operation.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
            }
        }
    


    




    public function get_governorates(Request $request)
    {
        if ($request->ajax()) {
            $country_id = $request->country_id;
            $other['governorates'] = get_cols_where(new governorates(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'countires_id' => $country_id));
            return view('admin.Operation.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.Operation.get_centers',['other'=>$other]);
        }
    }

    

    public function GovernmentProcess()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
         
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.Operation.GovernmentProcess', ['data' => $data,'other'=>$other]);
  
    }



    public function dailyReport_talabat()
    {
        $com_code = auth()->user()->com_code;
       $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'DESC');
       $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->orderBy( 'id', 'DESC')->paginate(20);
          return view('admin.Operation.dailyReport_talbat', ['data' => $data]);
    }

    public function importDailyTalabatReportIndex()
    {
        return view("admin.Operation.importDailyTalabatReport");

    }

    public function importDailyTalabatReportStore(importDailyTalabatReportRequest $request)
    {

        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

       
      


        //Excel::import(new AttendenceImport, $request->file('import_file'));
        
        try {
         //   Excel::import(new DailyTalabatReportImport($request->file('import_file')->extension()),$request->file('import_file'));
            Excel::import(new DailyTalabatReportImport($request->file('import_file')->extension(),$request->upload_date),$request->file('import_file'));
            }catch (\Error $ex) {
                        throw new \Exception('Error:' . $ex->getMessage());
                    }

     //   (new AttendenceImport)->import($request->file('import_file'));


       // Excel::toArray(new AttendenceImport, $request->file('import_file'));

        return redirect()->back()->with(['success' => 'تم تحديث البيانات بنجاح']);



    }

    public function monthlyReport_talabat()
    {
        $com_code = auth()->user()->com_code;
       $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'DESC');
       $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->orderBy( 'id', 'DESC')->paginate(20);
          return view('admin.Operation.monthlyReport_talbat', ['data' => $data]);
    }

    public function importMonthlyTalabatReportIndex()
    {
        return view("admin.Operation.importMonthlyTalabatReport");

    }

    public function importMonthlyTalabatReportStore(importMonthlyTalabatReportRequest $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);


        //Excel::import(new AttendenceImport, $request->file('import_file'));
        
        try {
            Excel::import(new MonthlyTalabatReportImport($request->file('import_file')->extension(),$request->registeration_date,$request->months),$request->file('import_file'));
            }catch (\Error $ex) {
                        throw new \Exception('Error:' . $ex->getMessage());
                    }

     //   (new AttendenceImport)->import($request->file('import_file'));


       // Excel::toArray(new AttendenceImport, $request->file('import_file'));

        return redirect()->back()->with(['success' => 'تم تحديث البيانات بنجاح']);



    }

    /////////////////////////////////////////////////////////////////////////////
public function ajax_update_operating_contract_type(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['operating_contract_type']=$request->operating_contract_type;
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
public function ajax_update_operating_company(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['operating_company']=$request->operating_company;
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
 public function ajax_update_Functional_status(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['Functional_status']=$request->Functional_status;
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
// public function ajax_search(Request $request)
// {
//     if ($request->ajax()) {
//         $searchbyradio = $request->searchbyradio;
//         $search_by_text = $request->search_by_text;
//         $vechile_car_or_bike = $request->vechile_car_or_bike;
//         $vechile_model = $request->vechile_model;
//         $vechile_status = $request->vechile_status;
//         $operating_company = $request->operating_company;
//         $operating_contract_type = $request->operating_contract_type;
       


//         if ($vechile_car_or_bike == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field6 = "id";
//             $operator6 = ">";
//             $value6 = 0;
//         } else {
//             $field6 = "operating_company";
//             $operator6 = "=";
//             $value6 = $operating_company;
//         }
//         if ($vechile_car_or_bike == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field5 = "id";
//             $operator5 = ">";
//             $value5 = 0;
//         } else {
//             $field5 = "operating_contract_type";
//             $operator5 = "=";
//             $value5 = $operating_contract_type;
//         }
//         if ($vechile_car_or_bike == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field4 = "id";
//             $operator4 = ">";
//             $value4 = 0;
//         } else {
//             $field4 = "vechile_car_or_bike";
//             $operator4 = "=";
//             $value4 = $vechile_car_or_bike;
//         }
//         if ($vechile_model == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field1 = "id";
//             $operator1 = ">";
//             $value1 = 0;
//         } else {
//             $field1 = "vechile_model";
//             $operator1 = "=";
//             $value1 = $vechile_model;
//         }
//         if ($vechile_status == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field2 = "id";
//             $operator2 = ">";
//             $value2 = 0;
//         } else {
//             $field2 = "vechile_status";
//             $operator2 = "=";
//             $value2 = $vechile_status;
//         }
//         if ($search_by_text != '') {
//             if($searchbyradio == 'vechile_no'){
//                 $field3 = "vechile_no";
//                 $operator3 = "like";
//                 $value3 = "%{$search_by_text}%";
//                 // $employee_id = Employee::select("id")->where($field5, $operator5, $value5)->where($field6, $operator6, $value6);
//                 // $vechile_id=Vechile_Information::select("id")->whereIn('vechile_driver',$employee_id)->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4);


//                 // $data =DB::table('employees')
//                 //             ->join('vechile_information','employees.id','=','vechile_information.vechile_driver')
//                 //             ->where('employees.driver_name','LIKE',"%{$search_by_text}%")
//                 //             ->select('employees.*','flats.*')
//                 //             ->orderby('employees.id', 'ASC')->paginate(PC);



//                             // $data = Employee::select('*')
//                             // ->join('vechile_information', 'vechile_information.vechile_driver', '=', 'employees.id')
//                             // ->where('employees'.$field5, $operator5, $value5)
//                             // ->where('employees'.$field6, $operator6, $value6)
//                             // ->where('vechile_information'.$field1, $operator1, $value1)
//                             // ->where('vechile_information'.$field2, $operator2, $value2)
//                             // ->where('vechile_information'.$field3, $operator3, $value3)
//                             // ->where('vechile_information'.$field4, $operator4, $value4)
//                             // ->orderby('employees.id', 'ASC')->paginate(PC)
//                             // ->get();


            
//                 // $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderby('id', 'ASC')->paginate(PC);
//             }elseif($searchbyradio == 'vechile_driver'){
//                 $field3 = "driver_name";
//                 $operator3 = "like";
//                 $value3 = "%{$search_by_text}%";

//                 // $data = DB::table('employees')
//                 // ->select('*')
//                 // ->join('vechile_information', 'vechile_information.vechile_driver', '=', 'employees.id')
//                 // ->where('employees'.$field5, $operator5, $value5)
//                 // ->where('employees'.$field6, $operator6, $value6)
//                 // ->where('vechile_information'.$field1, $operator1, $value1)
//                 // ->where('vechile_information'.$field2, $operator2, $value2)
//                 // ->where('vechile_information'.$field3, $operator3, $value3)
//                 // ->where('vechile_information'.$field4, $operator4, $value4)
//                 // ->orderby('employees.id', 'ASC')->paginate(PC);


//                 // $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderby('id', 'ASC')->paginate(PC);
//             }
//         }else{
//             $field3 = "id";
//             $operator3 = ">";
//             $value3 = 0;

//             //  $data = Employee::select('*')
//             //     ->join('vechile_information', 'vechile_information.vechile_driver', '=', 'employees.id')
//             //     ->where('employees'.$field5, $operator5, $value5)
//             //     ->where('employees'.$field6, $operator6, $value6)
//             //     ->where('vechile_information'.$field1, $operator1, $value1)
//             //     ->where('vechile_information'.$field2, $operator2, $value2)
//             //     ->where('vechile_information'.$field3, $operator3, $value3)
//             //     ->where('vechile_information'.$field4, $operator4, $value4)
//             //     ->orderby('employees.id', 'ASC')->paginate(PC)
//             //     ->get();


//            // $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderby('id', 'ASC')->paginate(PC);
//         }

//         $com_code = auth()->user()->com_code;

//         $data = DB::table('employees')
//         ->select('*')
//         ->join('vechile_information', 'vechile_information.vechile_driver', '=', 'employees.id')
//         ->where('employees'.$field5, $operator5, $value5)
//         ->where('employees'.$field6, $operator6, $value6)
//         ->where('vechile_information'.$field1, $operator1, $value1)
//         ->where('vechile_information'.$field2, $operator2, $value2)
//         ->where('vechile_information'.$field3, $operator3, $value3)
//         ->where('vechile_information'.$field4, $operator4, $value4)
//         ->orderby('employees.id', 'ASC')->paginate(PC);

//         $other['vechile_information'] = get_cols_where(new Vechile_Information(), array("*"),  array("com_code" => $com_code),'id','ASC');
//         $other['vechile_model'] = get_cols_where(new Vechile_Model(), array("*"),  array("com_code" => $com_code),'id','ASC');

//         return view('admin.Operation.ajax_search',  ['data' => $data,'other'=>$other]);
//     }
// }


public function ajax_search(Request $request)
{
    if ($request->ajax()) {
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $vechile_car_or_bike = $request->vechile_car_or_bike;
        $vechile_model = $request->vechile_model;
        $vechile_status = $request->vechile_status;
        $operating_company = $request->operating_company;
        $operating_contract_type = $request->operating_contract_type;
       

        if ($operating_contract_type == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "operating_contract_type";
            $operator6 = "=";
            $value6 = $operating_contract_type;
        }
        if ($operating_company == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "operating_company";
            $operator5 = "=";
            $value5 = $operating_company;
        }

        if ($vechile_car_or_bike == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "vechile_car_or_bike";
            $operator4 = "=";
            $value4 = $vechile_car_or_bike;
        }
        if ($vechile_model == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "vechile_model";
            $operator1 = "=";
            $value1 = $vechile_model;
        }
        if ($vechile_status == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "vechile_status";
            $operator2 = "=";
            $value2 = $vechile_status;
        }
        if ($search_by_text != '') {
            if($searchbyradio == 'vechile_no'){
                $field3 = "vechile_no";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
            //  $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
            $employee_id=Employee::select("id")->where($field5, $operator5, $value5)->where($field6, $operator6, $value6);
            $vechile_driver = Vechile_Information::select("vechile_driver")->whereIn('vechile_driver',$employee_id)->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4);
          //  $data=$vechile_id::select("id")->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);
          $data=Employee::select("*")->whereIn('id',$vechile_driver)->where('Functional_status','=',2)->orderby('id', 'ASC')->paginate(PC);
        }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $data=Employee::select("*")->where($field3, $operator3, $value3)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->where('Functional_status','=',2)->orderby('id', 'ASC')->paginate(PC);
            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
            $data=Employee::select("*")->where($field3, $operator3, $value3)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->where('Functional_status','=',2)->orderby('id', 'ASC')->paginate(PC);
        }             


        $com_code = auth()->user()->com_code;

        //$data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);

         // $data = DB::table('employees')
            // ->select('*')
            // ->join('vechile_information', 'vechile_information.vechile_driver', '=', 'employees.id')
            // ->where('employees'.$field5, $operator5, $value5)
            // ->where('employees'.$field6, $operator6, $value6)
            // ->where('vechile_information'.$field1, $operator1, $value1)
            // ->where('vechile_information'.$field2, $operator2, $value2)
            // ->where('vechile_information'.$field3, $operator3, $value3)
            // ->where('vechile_information'.$field4, $operator4, $value4)
            // ->orderby('employees.id', 'ASC')->paginate(PC);
        $other['vechile_information'] = get_cols_where(new Vechile_Information(), array("*"),  array("com_code" => $com_code),'id','ASC');
        $other['vechile_model'] = get_cols_where(new Vechile_Model(), array("*"),  array("com_code" => $com_code),'id','ASC');

        //dd($data);

        return view('admin.Operation.ajax_search',  ['data' => $data,'other'=>$other]);
    }
}

 //=============================================================================================

 public function print_operation_index(Request $request)
 {
         $searchbyradio = $request->searchbyradio;
         $search_by_text = $request->search_by_text;
         $vechile_car_or_bike = $request->vechile_car_or_bike_search;
         $vechile_model = $request->vechile_model_search;
         $vechile_status = $request->vechile_status_search;
         $operating_company = $request->operating_company_search;
         $operating_contract_type = $request->operating_contract_type_search;
        
 
         if ($operating_contract_type == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field6 = "id";
             $operator6 = ">";
             $value6 = 0;
         } else {
             $field6 = "operating_contract_type";
             $operator6 = "=";
             $value6 = $operating_contract_type;
         }
         if ($operating_company == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field5 = "id";
             $operator5 = ">";
             $value5 = 0;
         } else {
             $field5 = "operating_company";
             $operator5 = "=";
             $value5 = $operating_company;
         }
 
         if ($vechile_car_or_bike == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field4 = "id";
             $operator4 = ">";
             $value4 = 0;
         } else {
             $field4 = "vechile_car_or_bike";
             $operator4 = "=";
             $value4 = $vechile_car_or_bike;
         }
         if ($vechile_model == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field1 = "id";
             $operator1 = ">";
             $value1 = 0;
         } else {
             $field1 = "vechile_model";
             $operator1 = "=";
             $value1 = $vechile_model;
         }
         if ($vechile_status == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field2 = "id";
             $operator2 = ">";
             $value2 = 0;
         } else {
             $field2 = "vechile_status";
             $operator2 = "=";
             $value2 = $vechile_status;
         }
         if ($search_by_text != '') {
             if($searchbyradio == 'vechile_no'){
                 $field3 = "vechile_no";
                 $operator3 = "like";
                 $value3 = "%{$search_by_text}%";
             //  $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
             $employee_id=Employee::select("id")->where($field5, $operator5, $value5)->where($field6, $operator6, $value6);
             $vechile_driver = Vechile_Information::select("vechile_driver")->whereIn('vechile_driver',$employee_id)->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4);
           //  $data=$vechile_id::select("id")->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);
           $data=Employee::select("*")->whereIn('id',$vechile_driver)->where('Functional_status','=',2)->orderby('id', 'ASC')->get();
         }elseif($searchbyradio == 'vechile_driver'){
                 $field3 = "driver_name";
                 $operator3 = "like";
                 $value3 = "%{$search_by_text}%";
                 $data=Employee::select("*")->where($field3, $operator3, $value3)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->where('Functional_status','=',2)->orderby('id', 'ASC')->get();
             }
         }else{
             $field3 = "id";
             $operator3 = ">";
             $value3 = 0;
             $data=Employee::select("*")->where($field3, $operator3, $value3)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->where('Functional_status','=',2)->orderby('id', 'ASC')->get();
         }             

         $com_code = auth()->user()->com_code;
         $other['vechile_information'] = get_cols_where(new Vechile_Information(), array("*"),  array("com_code" => $com_code),'id','ASC');
         $other['vechile_model'] = get_cols_where(new Vechile_Model(), array("*"),  array("com_code" => $com_code),'id','ASC');
 
         $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));
       
 
         return view('admin.Operation.print_operationIndex',  ['data' => $data,'other'=>$other,'systemData'=>$systemData]);
 }
 
  //=============================================================================================
 

public function daily_report_ajax_search(Request $request)
{
    if ($request->ajax()) {
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $daily_report_date_from = $request->daily_report_date_from;
        $daily_report_date_to = $request->daily_report_date_to;
        $search_type = $request->search_type;
        $min_value = $request->min_value;
        $max_value = $request->max_value;
       

        if ($daily_report_date_from == '') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "date";
            $operator6 = ">=";
            $value6 = $daily_report_date_from;
        }
        if ($daily_report_date_to == '') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "date";
            $operator5 = "<=";
            $value5 = $daily_report_date_to;
        }

        if ($min_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = $search_type;
            $operator4 = ">=";
            $value4 = (float)$min_value;
        }
        if ($max_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = $search_type;
            $operator1 = "<=";
            $value1 = (float)$max_value;
        }
      
        if ($search_by_text != '') {
            if($searchbyradio == 'vechile_no'){
                $field3 = "vechile_no";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
            $vechile_driver = Vechile_Information::select("vechile_driver")->where($field3, $operator3, $value3);
            $operating_talabat_no=Employee::select("operating_talabat_no")->whereIn('id',$vechile_driver)->orderby('id', 'ASC');
            $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);
        }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $operating_talabat_no=Employee::select("operating_talabat_no")->where($field3, $operator3, $value3)->orderby('id', 'ASC');
                $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);

            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
           // $data = OperatingTalabatDailyReport::select("*")->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->whereIn('rider_id',$operating_talabat_no)->orderBy( 'id', 'DESC')->paginate(20);
           $com_code = auth()->user()->com_code;
           $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'DESC');
            $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);

           // $operating_talabat_no=Employee::select("operating_talabat_no")->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);
        }             


        // $com_code = auth()->user()->com_code;
        // $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'DESC');
           return view('admin.Operation.daily_report_ajax_search', ['data' => $data]);
           
        // return view('admin.Operation.ajax_search',  ['data' => $data,'other'=>$other]);
    }
}

 //=============================================================================================

  //=============================================================================================
public function print_daily_report(Request $request)
{
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $daily_report_date_from = $request->daily_report_date_from;
        $daily_report_date_to = $request->daily_report_date_to;
        $search_type = $request->search_type;
        $min_value = $request->min_value;
        $max_value = $request->max_value;
       

        if ($daily_report_date_from == '') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "date";
            $operator6 = ">=";
            $value6 = $daily_report_date_from;
        }
        if ($daily_report_date_to == '') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "date";
            $operator5 = "<=";
            $value5 = $daily_report_date_to;
        }

        if ($min_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = $search_type;
            $operator4 = "<=";
            $value4 = $min_value;
        }
        if ($max_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = $search_type;
            $operator1 = ">=";
            $value1 = $max_value;
        }
      
        if ($search_by_text != '') {
            if($searchbyradio == 'vechile_no'){
                $field3 = "vechile_no";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
            $vechile_driver = Vechile_Information::select("vechile_driver")->where($field3, $operator3, $value3);
            $operating_talabat_no=Employee::select("operating_talabat_no")->whereIn('id',$vechile_driver)->orderby('id', 'ASC');
            $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();
        }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $operating_talabat_no=Employee::select("operating_talabat_no")->where($field3, $operator3, $value3)->orderby('id', 'ASC');
                $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();

            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
           // $data = OperatingTalabatDailyReport::select("*")->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->whereIn('rider_id',$operating_talabat_no)->orderBy( 'id', 'DESC')->paginate(20);
           $com_code = auth()->user()->com_code;
           $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'ASC');
            $data = OperatingTalabatDailyReport::select("*")->whereIn('rider_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();
        }             

        $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));


        return view('admin.Operation.print_dailyReport_talabat', ['data' => $data,'systemData'=>$systemData]);
             
}

 //============================================================================================= 
public function monthly_report_ajax_search(Request $request)
{
    if ($request->ajax()) {
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $year = $request->year;
        $month = $request->month;
        $search_type = $request->search_type;
        $min_value = $request->min_value;
        $max_value = $request->max_value;
       

        if ($year == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "year";
            $operator6 = "=";
            $value6 = $year;
        }
        if ($month == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "month";
            $operator5 = "=";
            $value5 = $month;
        }

        if ($min_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = $search_type;
            $operator4 = ">=";
            $value4 = (float)$min_value;
        }
        if ($max_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = $search_type;
            $operator1 = "<=";
            $value1 = (float)$max_value;
        }
      
        if ($search_by_text != '') {
            if($searchbyradio == 'vechile_no'){
                $field3 = "vechile_no";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
            $vechile_driver = Vechile_Information::select("vechile_driver")->where($field3, $operator3, $value3);
            $operating_talabat_no=Employee::select("operating_talabat_no")->whereIn('id',$vechile_driver)->orderby('id', 'ASC');
            $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);
        }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $operating_talabat_no=Employee::select("operating_talabat_no")->where($field3, $operator3, $value3)->orderby('id', 'ASC');
                $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);
            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
            $com_code = auth()->user()->com_code;
            $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'ASC');
             $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'DESC')->paginate(20);
         }             

           return view('admin.Operation.monthly_report_ajax_search', ['data' => $data]);
           
    }
}

 //=============================================================================================
//============================================================================================= 
public function print_monthly_report(Request $request)
{
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $year = $request->year;
        $month = $request->months;
        $search_type = $request->search_type;
        $min_value = $request->min_value;
        $max_value = $request->max_value;
       

        if ($year == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "year";
            $operator6 = "=";
            $value6 = $year;
        }
        if ($month == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "month";
            $operator5 = "=";
            $value5 = $month;
        }

        if ($min_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = $search_type;
            $operator4 = ">=";
            $value4 = $search_type;
        }
        if ($max_value=='') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = $search_type;
            $operator1 = "<=";
            $value1 = $search_type;
        }
      
        if ($search_by_text != '') {
            if($searchbyradio == 'vechile_no'){
                $field3 = "vechile_no";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
            $vechile_driver = Vechile_Information::select("vechile_driver")->where($field3, $operator3, $value3);
            $operating_talabat_no=Employee::select("operating_talabat_no")->whereIn('id',$vechile_driver)->orderby('id', 'ASC');
            $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();
        }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $operating_talabat_no=Employee::select("operating_talabat_no")->where($field3, $operator3, $value3)->orderby('id', 'ASC');
                $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();
            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
            $com_code = auth()->user()->com_code;
            $operating_talabat_no = get_cols_where(new Employee(),array("operating_talabat_no"),array('com_code' => $com_code),'id', 'ASC');
             $data = OperatingTalabatMonthlyReport::select("*")->whereIn('talabat_id',$operating_talabat_no)->where($field1, $operator1, $value1)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->where($field6, $operator6, $value6)->orderBy( 'id', 'ASC')->get();
         }             

         $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));


         return view('admin.Operation.print_monthlyReport_talabat', ['data' => $data,'systemData'=>$systemData]);
    
}
 //=============================================================================================

/////////////////////////////////////////////////////////////////////////////
public function ajax_search_GovernmentProcess(Request $request)
{
    if ($request->ajax()) {
        $search_by_text = $request->search_by_text;
        $residency_process_status_search = $request->residency_process_status_search;
        $driver_bank_process_search = $request->driver_bank_process_search;
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
        if ($residency_process_status_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "driver_residency_process_status";
            $operator2 = "=";
            $value2 = $residency_process_status_search;
        }
        if ($driver_bank_process_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "driver_bank_process";
            $operator3 = "=";
            $value3 = $driver_bank_process_search;
        }
        if ($Functional_status_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "Functional_status";
            $operator4 = "=";
            $value4 = $Functional_status_search;
        }
        $com_code = auth()->user()->com_code;
        $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.Operation.ajax_search_GovernmentProcess', ['data' => $data,'other'=>$other]);
  
        // return view('admin.Housing.ajax_search', ['data' => $data,'flats'=>$flats]);
        }
}
/////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////
public function print_GovernmentProcess_search(Request $request)
{
        $search_by_text = $request->search_by_text;
        $residency_process_status_search = $request->residency_process_status_search;
        $driver_bank_process_search = $request->driver_bank_process_search;
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
        if ($residency_process_status_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "driver_residency_process_status";
            $operator2 = "=";
            $value2 = $residency_process_status_search;
        }
        if ($driver_bank_process_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "driver_bank_process";
            $operator3 = "=";
            $value3 = $driver_bank_process_search;
        }
        if ($Functional_status_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "Functional_status";
            $operator4 = "=";
            $value4 = $Functional_status_search;
        }
        $com_code = auth()->user()->com_code;
        $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->get();
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');

        $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));


        return view('admin.Operation.print_GovernmentProcess_search', ['data' => $data,'other'=>$other,'systemData'=>$systemData]);
  
        
}
/////////////////////////////////////////////////////////////////////////////

}
