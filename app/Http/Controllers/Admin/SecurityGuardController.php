<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Admin;
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
use App\Models\Deposit;
use App\Models\DriversDeposit;
use App\Models\DriversDepositItems;
use App\Models\Driving_school_status;
use App\Models\driving_license_type;
use App\Models\Language;
use App\Models\Shifts_type;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SecurityGuardController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $driversdeposit = get_cols_where_p(new DriversDeposit(), array("*"), array("com_code" => $com_code), 'id', 'desc', PC);
        return view("admin.SecurityGard.index", ['data' => $data,'driversdeposit'=>$driversdeposit]);
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

        return view("admin.TheLegal.index", ['other' => $other]);
    }

    public function store(Request $request)
    {
       
    }

    public function edit($driver_id){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Employee(), array("*"), array("id" => $driver_id, 'com_code' => $com_code));
        $deposits = get_cols_where(new Deposit(), array("*"), array('com_code' => $com_code));
        if (empty($data)) {
        return redirect()->route('SecurityGuard_Receive.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.SecurityGard.edit', ['data' => $data ,'deposits' => $deposits]);

    }

    public function storeDeposit(Request $request)
    {

        $request->validate([
            'inputs.*.name'=>'required',
        ],
        [
            'inputs.*.name'=>'الاسم مطلوب',
        ]
        
        );
                 $com_code = auth()->user()->com_code;
                //  $DataToInsert['name'] = $request->note;
                 $DataToInsert['date'] = date("Y-m-d");
                 $DataToInsert['driver_id'] = $request->driver_id;
                 $DataToInsert['amount'] =  var_dump(count($request->inputs, COUNT_RECURSIVE));
                 $DataToInsert['added_by'] = auth()->user()->id;
                 $DataToInsert['com_code'] = $com_code;
                 $note= insert(new DriversDeposit(), $DataToInsert);
            if (!$note) {
                return redirect()->back()->with(['error' => 'عفوا حدث خطاء ما '])->withInput();
            }
           // array_push($request->inputs, $note->id);
           //echo($request->inputs[0].value('name'));
        foreach ($request->inputs as $key => $value) {
            $value['daily_employees_report_id']=$note->id;
            $value['date']=date("Y-m-d");
            $value['com_code']=auth()->user()->com_code;
            $value['added_by']=auth()->user()->id;
            //$request->inputs['key']['daily_employees_report_id']=$note->id;
            DriversDepositItems::create($value);
        }
        // return back()->with('success','تم تسليم الامانات');
        return redirect()->route('SecurityGuard_Receive.index')->with(['success' => ' Deposits have been successfully delivered.']);
    }


    public function show_drivers_deposit()
    {
        $com_code = auth()->user()->com_code;
       // $mytime = Carbon::now();
      // echo $mytime->toDateTimeString();2024-03-10

        // $today = Carbon::now()->format('Y-m-d');

      //  $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
      $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), 'id', 'ASC', PC);
     
     
      $driversdeposit = get_cols_where_p(new DriversDeposit(), array("*"), array("com_code" => $com_code,"report_status"=>0), 'id', 'desc', PC);
  
      $driversDepositItems = get_cols_where(new DriversDepositItems(), array("*"), array("com_code" => $com_code),'id','ASC');

      $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));
 
        return view('admin.SecurityGard.show_drivers_deposit2', ['data' => $data,'driversdeposit'=>$driversdeposit,'driversDepositItems'=>$driversDepositItems,'admins'=>$admins]);
  
    }

    /////////////////////////////////////////////////////////////////////////////

public function ajax_update_report_status(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['report_status']=$request->report_status;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new DriversDeposit(), array("*"), array('com_code' => $com_code, 'id' => $request->report_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new DriversDeposit(),$data_to_update, array("com_code" => $com_code,'id' => $request->report_id_value));
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
// public function ajax_daily_report_search(Request $request)
//     {
//         if ($request->ajax()) {
//             $searchbyradio = $request->searchbyradio;
//             $search_by_text = $request->search_by_text;
//             $search_by_guard_name = $request->search_by_guard_name;
//             $report_date_search = $request->report_date_search;
//             $report_status_search = $request->report_status_search;

//             if ($search_by_text != '') {
//                 if($searchbyradio == 'name'){
//                     $field5 = "driver_name";
//                     $operator5 = "like";
//                     $value5 = "%{$search_by_text}%";
//                 }elseif($searchbyradio == 'baladi_id'){
//                     $field5 = "baladi_id";
//                     $operator5 = "like";
//                     $value5 = "%{$search_by_text}%";
//                 }else{
//                     $field5 = "driver_quater_tel";
//                     $operator5 = "like";
//                     $value5 = "%{$search_by_text}%";
//                 }
//             }else{
//                 $field5 = "id";
//                 $operator5 = ">";
//                 $value5 = 0;
//             }

            
//             if ($search_by_guard_name == 'all') {
//                 //هنا نعمل شرط دائم التحقق
//                 $field1 = "id";
//                 $operator1 = ">";
//                 $value1 = 0;
//             } else {
//                 $field1 = "added_by";
//                 $operator1 = "=";
//                 $value1 = "$search_by_guard_name";
//             }
//             if ($report_date_search == '') {
//                 //هنا نعمل شرط دائم التحقق
//                 $field2 = "id";
//                 $operator2 = ">";
//                 $value2 = 0;
//             } else {
//                 $field2 = "date";
//                 $operator2 = "LIKE";
//                 $value2 = "%{$report_date_search}%";
//             }
//             if ($report_status_search == 'all') {
//                 //هنا نعمل شرط دائم التحقق
//                 $field3 = "id";
//                 $operator3 = ">";
//                 $value3 = 0;
//             } else {
//                 $field3 = "report_status";
//                 $operator3 = "=";
//                 $value3 = $report_status_search;
//             }
//              $employee_id=Employee::select("id")->where($field5, $operator5, $value5);
//             $data = DriversDeposit::select("*")->whereIn('driver_id',$employee_id)->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'DESC')->paginate(PC);
//             // $data = DriversDeposit::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'DESC')->paginate(PC);
//             $dailyEmployeesReportTasks = get_cols_where(new DriversDepositItems(), array("*"), array("com_code" => 1));
//             $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));

         

//             return view('admin.SecurityGard.ajax_daily_report_search', ['data' => $data,'dailyEmployeesReportTasks'=>$dailyEmployeesReportTasks,'admins'=>$admins,'today'=>$report_date_search]);
//             }
//     }
    /////////////////////////////////////////////////////////////////////////////
    

    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('TheLegal.index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }


            DB::beginTransaction();

            $dataToUpdate['isSigningInitialContract'] = $request->isSigningInitialContract;

            if($request->has('initial_contract_image')){
                $request->validate([
                    'initial_contract_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->initial_contract_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }

                
                $the_file_path=uploadImage('assets/admin/uploads',$request->initial_contract_image);
                $dataToUpdate['initial_contract_image']=$the_file_path;
            }
            $dataToUpdate['isSigningMainContract'] = $request->isSigningMainContract;

            if($request->has('isSigningMainContractImage')){
                $request->validate([
                    'isSigningMainContractImage'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->isSigningMainContractImage;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }

                $the_file_path=uploadImage('assets/admin/uploads',$request->isSigningMainContractImage);
                $dataToUpdate['isSigningMainContractImage']=$the_file_path;
            }
            $dataToUpdate['isGivePassPort'] = $request->isGivePassPort;

            if($request->has('give_passport_image')){
                $request->validate([
                    'give_passport_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->give_passport_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }

                $the_file_path=uploadImage('assets/admin/uploads',$request->give_passport_image);
                $dataToUpdate['give_passport_image']=$the_file_path;
            }
            $dataToUpdate['isSigningFullFinancialDebt'] = $request->isSigningFullFinancialDebt;

            if($request->has('SigningFullFinancialDebt_Image')){
                $request->validate([
                    'SigningFullFinancialDebt_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->SigningFullFinancialDebt_Image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }


                $the_file_path=uploadImage('assets/admin/uploads',$request->SigningFullFinancialDebt_Image);
                $dataToUpdate['SigningFullFinancialDebt_Image']=$the_file_path;
            }
            $dataToUpdate['isSigningPenaltyClause'] = $request->isSigningPenaltyClause;

            if($request->has('isSigningPenaltyClause_Image')){
                $request->validate([
                    'isSigningPenaltyClause_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->isSigningPenaltyClause_Image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }


                $the_file_path=uploadImage('assets/admin/uploads',$request->isSigningPenaltyClause_Image);
                $dataToUpdate['isSigningPenaltyClause_Image']=$the_file_path;
            }
            $dataToUpdate['isSigningFullFinancialDebtCheck'] = $request->isSigningFullFinancialDebtCheck;

            if($request->has('SigningFullFinancialDebtCheck_Image')){
                $request->validate([
                    'SigningFullFinancialDebtCheck_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->SigningFullFinancialDebtCheck_Image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }

                $the_file_path=uploadImage('assets/admin/uploads',$request->SigningFullFinancialDebtCheck_Image);
                $dataToUpdate['SigningFullFinancialDebtCheck_Image']=$the_file_path;
            }
            $dataToUpdate['isSigningPenaltyClauseCheck'] = $request->isSigningPenaltyClauseCheck;

            if($request->has('isSigningPenaltyClauseCheck_Image')){
                $request->validate([
                    'isSigningPenaltyClauseCheck_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->isSigningPenaltyClauseCheck_Image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }


                $the_file_path=uploadImage('assets/admin/uploads',$request->isSigningPenaltyClauseCheck_Image);
                $dataToUpdate['isSigningPenaltyClauseCheck_Image']=$the_file_path;
            }
           

            update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('TheLegal.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
            return view('admin.Employees.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.Employees.get_centers',['other'=>$other]);
        }
    }

    /////////////////////////////////////////////////////////////////////////////

  public function ajax_update_isSigningInitialContract(Request $request)
  {
      if ($request->ajax()) {
          try {
            $com_code = auth()->user()->com_code;
            $data_to_update['isSigningInitialContract']=$request->isSigningInitialContract;
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

 public function ajax_update_isGivePassPort(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['isGivePassPort']=$request->isGivePassPort;
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

 public function ajax_update_isSigningMainContract(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['isSigningMainContract']=$request->isSigningMainContract;
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

 public function ajax_update_isSigningFullFinancialDebt(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['isSigningFullFinancialDebt']=$request->isSigningFullFinancialDebt;
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

 public function ajax_update_isSigningPenaltyClause(Request $request)
 {
     if ($request->ajax()) {
         try {
           $com_code = auth()->user()->com_code;
           $data_to_update['isSigningPenaltyClause']=$request->isSigningPenaltyClause;
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

    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $searchbyradio = $request->searchbyradio;
            $search_by_text = $request->search_by_text;
           
            if ($search_by_text != '') {
                if($searchbyradio == 'name'){
                    $field5 = "driver_name";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }elseif($searchbyradio == 'baladi_id'){
                    $field5 = "baladi_id";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }else{
                    $field5 = "driver_quater_tel";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }
            }else{
                $field5 = "id";
                $operator5 = ">";
                $value5 = 0;
            }

            $com_code = auth()->user()->com_code;

            $data = Employee::select("*")->where($field5, $operator5, $value5)->orderby('id', 'ASC')->paginate(PC);
            $driversdeposit = get_cols_where_p(new DriversDeposit(), array("*"), array("com_code" => $com_code), 'id', 'desc', PC);
            return view('admin.SecurityGard.ajax_search', ['data' => $data,'driversdeposit'=>$driversdeposit]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////

     /////////////////////////////////////////////////////////////////////////////

     public function ajax_show_drivers_deposit_search(Request $request)
     {
         if ($request->ajax()) {
             $searchbyradio = $request->searchbyradio;
             $search_by_text = $request->search_by_text;
            
             if ($search_by_text != '') {
                 if($searchbyradio == 'name'){
                     $field5 = "driver_name";
                     $operator5 = "like";
                     $value5 = "%{$search_by_text}%";
                 }elseif($searchbyradio == 'baladi_id'){
                     $field5 = "baladi_id";
                     $operator5 = "like";
                     $value5 = "%{$search_by_text}%";
                 }else{
                     $field5 = "driver_quater_tel";
                     $operator5 = "like";
                     $value5 = "%{$search_by_text}%";
                 }
             }else{
                 $field5 = "id";
                 $operator5 = ">";
                 $value5 = 0;
             }
 
             $com_code = auth()->user()->com_code;
 
             $data = Employee::select("*")->where($field5, $operator5, $value5)->orderby('id', 'ASC')->paginate(PC);
             $driversdeposit = get_cols_where_p(new DriversDeposit(), array("*"), array("com_code" => $com_code,"report_status"=>0), 'id', 'desc', PC);


             $driversDepositItems = get_cols_where(new DriversDepositItems(), array("*"), array("com_code" => $com_code),'id','ASC');

             $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));
        
               return view('admin.SecurityGard.ajax_show_drivers_deposit_search', ['data' => $data,'driversdeposit'=>$driversdeposit,'driversDepositItems'=>$driversDepositItems,'admins'=>$admins]);
  
               


            //  return view('admin.SecurityGard.ajax_show_drivers_deposit_search', ['data' => $data,'driversdeposit'=>$driversdeposit]);
         }
     }
     /////////////////////////////////////////////////////////////////////////////
 

}
