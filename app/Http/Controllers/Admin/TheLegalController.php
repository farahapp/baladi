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

class TheLegalController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        return view("admin.TheLegal.index", ['data' => $data]);
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
        if (empty($data)) {
        return redirect()->route('TheLegal.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.TheLegal.edit', ['data' => $data]);

    }

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
            $isGivePassPort = $request->isGivePassPort;
            $isSigningMainContract = $request->isSigningMainContract;
            $isSigningFullFinancialDebt = $request->isSigningFullFinancialDebt;
            $isSigningPenaltyClause = $request->isSigningPenaltyClause;

            if ($isGivePassPort == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "isGivePassPort";
                $operator1 = "=";
                $value1 = $isGivePassPort;
            }
            if ($isSigningMainContract == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "isSigningMainContract";
                $operator2 = "=";
                $value2 = $isSigningMainContract;
            }
            if ($isSigningFullFinancialDebt == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "isSigningFullFinancialDebt";
                $operator3 = "=";
                $value3 = $isSigningFullFinancialDebt;
            }
            if ($isSigningPenaltyClause == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field4 = "id";
                $operator4 = ">";
                $value4 = 0;
            } else {
                $field4 = "isSigningPenaltyClause";
                $operator4 = "=";
                $value4 = $isSigningPenaltyClause;
            }
            if ($search_by_text != '') {
                if($searchbyradio == 'name'){
                    $field5 = "driver_name";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }elseif($searchbyradio == 'id_number'){
                    $field5 = "driver_residency_permit_id";
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
            $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->orderby('id', 'ASC')->paginate(PC);
            return view('admin.TheLegal.ajax_search', ['data' => $data]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////


}
