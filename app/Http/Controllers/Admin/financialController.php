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
use App\Models\GeneralLoan;
use App\Models\Language;
use App\Models\Shifts_type;
use App\Models\SpecialLoan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class financialController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        $specialLoan = get_cols_where_p(new SpecialLoan(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);

        return view("admin.financial.index", ['data' => $data,'specialLoan' => $specialLoan]);
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

        return view("admin.financial.create", ['other' => $other]);
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
        return view('admin.financial.edit', ['data' => $data]);
    }


    
    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('financial.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة !']);
            }


            DB::beginTransaction();

           
          


            $dataToUpdate['isPostPayInSudan'] = $request->isPostPayInSudan;
            if($request->isPostPayInSudan==1)
        {
            $dataToUpdate['post_pay_amount'] = $request->post_pay_amount;
        }
            if($request->has('post_pay_pill_image')){
                $request->validate([
                    'post_pay_pill_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->post_pay_pill_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }

                $the_file_path=uploadImage('assets/admin/uploads',$request->post_pay_pill_image);
                $dataToUpdate['post_pay_pill_image']=$the_file_path;
            }
           
            

           
           

            if($request->driver_financial_notes!=''||$request->driver_financial_notes!=null)
            {
                $dataToUpdate['driver_financial_notes'] = $request->driver_financial_notes;
            }

           

            
            $dataToUpdate['updated_by'] = auth()->user()->id;
            update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('financial.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function employees(){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.financial.generalLoans", ['data' => $data]);
    }


    public function generalLoans_index(){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new GeneralLoan(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.financial.generalLoans_index", ['data' => $data]);
    }

  

    public function generalLoans_edit($driver_id){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Employee(), array("*"), array("id" => $driver_id, 'com_code' => $com_code));

        $generalloan = get_cols_where_row(new GeneralLoan(), array("*"), array("driver_id" => $driver_id));
        if (empty($generalloan)) {
            DB::beginTransaction();
            $DataToInsert['total_loan'] = '10555';
            $DataToInsert['total_loan_remaining'] = '10555';
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['driver_id'] = $driver_id;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new GeneralLoan(), $DataToInsert);
            DB::commit();
        }
         $generalloan = get_cols_where_row(new GeneralLoan(), array("*"), array("driver_id" => $driver_id));
        if (empty($generalloan)) {
            DB::beginTransaction();
            $DataToInsert['total_loan'] = '10555';
            $DataToInsert['total_loan_remaining'] = '10555';
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['driver_id'] = $driver_id;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new GeneralLoan(), $DataToInsert);
            DB::commit();
        }

        if (empty($data)) {
        return redirect()->route('financial.generalLoans_index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }

////////////////////////////////////////////////
// $generalloan2 = get_cols_where_row(new GeneralLoan(), array("*"), array("driver_id" => $driver_id));

//         $total_loan=
//         $generalloan2->services_fees+
//         $generalloan2->visa_print+
//         $generalloan2->first_month_rent_and_food+
//         $generalloan2->commision+
//         $generalloan2->accomodation_preparation+
//         $generalloan2->uniform+
//         $generalloan2->sim_and_photo+
//         $generalloan2->transportaion+
//         $generalloan2->medical+
//         $generalloan2->e_contract+
//         $generalloan2->qid_issuing+
//         $generalloan2->health_card+
//         $generalloan2->school_registration+
//         $generalloan2->liesence_print+
//         $generalloan2->second_month_rent_and_food+
//         $generalloan2->third_month_rent_and_food+
//         $generalloan2->training_1st_and_2nd_month+
//         $generalloan2->phone_loan;

//         $total_loan_paid=
//         $generalloan->services_fees_paid+
//         $generalloan->visa_print_paid+
//         $generalloan->first_month_rent_and_food_paid+
//         $generalloan->commision_paid+
//         $generalloan->accomodation_preparation_paid+
//         $generalloan->uniform_paid+
//         $generalloan->sim_and_photo_paid+
//         $generalloan->transportaion_paid+
//         $generalloan->medical_paid+
//         $generalloan->e_contract_paid+
//         $generalloan->qid_issuing_paid+
//         $generalloan->health_card_paid+
//         $generalloan->school_registration_paid+
//         $generalloan->liesence_print_paid+
//         $generalloan->second_month_rent_and_food_paid+
//         $generalloan->third_month_rent_and_food_paid+
//         $generalloan->training_1st_and_2nd_month_paid+
//         $generalloan->phone_loan_paid;


//         $total_loan_remaining=$total_loan;

//         DB::beginTransaction();
//             $dataToUpdate['total_loan'] = $total_loan;
//             $dataToUpdate['total_loan_remaining'] = $total_loan_remaining;
//             update(new GeneralLoan(), $dataToUpdate, array('com_code' => $com_code, 'id' => $generalloan2->id));
//             DB::commit();

////////////////////////////////////////////////////////


        return view('admin.financial.generalLoans_edit', ['data' => $data,'generalloan'=> $generalloan]);

}


public function generalLoans_update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new GeneralLoan(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('financial.generalLoans_index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }


            DB::beginTransaction();
            $dataToUpdate['services_fees'] = $request->services_fees;
            $dataToUpdate['services_fees_paid'] = $request->services_fees_paid;
            $dataToUpdate['services_fees_remaining'] = $request->services_fees-$request->services_fees_paid;
            $dataToUpdate['visa_print'] = $request->visa_print;
            $dataToUpdate['visa_print_paid'] = $request->visa_print_paid;
            $dataToUpdate['visa_print_remaining'] = $request->visa_print-$request->visa_print_paid;
            $dataToUpdate['first_month_rent_and_food'] = $request->first_month_rent_and_food;
            $dataToUpdate['first_month_rent_and_food_paid'] = $request->first_month_rent_and_food_paid;
            $dataToUpdate['first_month_rent_and_food_remaining'] = $request->first_month_rent_and_food-$request->first_month_rent_and_food_paid;
            $dataToUpdate['commision'] = $request->commision;
            $dataToUpdate['commision_paid'] = $request->commision_paid;
            $dataToUpdate['commision_remaining'] = $request->commision-$request->commision_paid;
            $dataToUpdate['accomodation_preparation'] = $request->accomodation_preparation;
            $dataToUpdate['accomodation_preparation_paid'] = $request->accomodation_preparation_paid;
            $dataToUpdate['accomodation_preparation_remaining'] = $request->accomodation_preparation-$request->accomodation_preparation_paid;
            $dataToUpdate['uniform'] = $request->uniform;
            $dataToUpdate['uniform_paid'] = $request->uniform_paid;
            $dataToUpdate['uniform_remaining'] = $request->uniform-$request->uniform_paid;
            $dataToUpdate['sim_and_photo'] = $request->sim_and_photo;
            $dataToUpdate['sim_and_photo_paid'] = $request->sim_and_photo_paid;
            $dataToUpdate['sim_and_photo_remaining'] = $request->sim_and_photo-$request->sim_and_photo_paid;
            $dataToUpdate['transportaion'] = $request->transportaion;
            $dataToUpdate['transportaion_paid'] = $request->transportaion_paid;
            $dataToUpdate['transportaion_remaining'] = $request->transportaion-$request->transportaion_paid;
            $dataToUpdate['medical'] = $request->medical;
            $dataToUpdate['medical_paid'] = $request->medical_paid;
            $dataToUpdate['medical_remaining'] = $request->medical-$request->medical_paid;
            $dataToUpdate['e_contract'] = $request->e_contract;
            $dataToUpdate['e_contract_paid'] = $request->e_contract_paid;
            $dataToUpdate['e_contract_remaining'] = $request->e_contract-$request->e_contract_paid;
            $dataToUpdate['qid_issuing'] = $request->qid_issuing;
            $dataToUpdate['qid_issuing_paid'] = $request->qid_issuing_paid;
            $dataToUpdate['qid_issuing_remaining'] = $request->qid_issuing-$request->qid_issuing_paid;
            $dataToUpdate['health_card'] = $request->health_card;
            $dataToUpdate['health_card_paid'] = $request->health_card_paid;
            $dataToUpdate['health_card_remaining'] = $request->health_card-$request->health_card_paid;
            $dataToUpdate['school_registration'] = $request->school_registration;
            $dataToUpdate['school_registration_paid'] = $request->school_registration_paid;
            $dataToUpdate['school_registration_remaining'] = $request->school_registration-$request->school_registration_paid;
            $dataToUpdate['liesence_print'] = $request->liesence_print;
            $dataToUpdate['liesence_print_paid'] = $request->liesence_print_paid;
            $dataToUpdate['liesence_print_remaining'] = $request->liesence_print-$request->liesence_print_paid;
            $dataToUpdate['second_month_rent_and_food'] = $request->second_month_rent_and_food;
            $dataToUpdate['second_month_rent_and_food_paid'] = $request->second_month_rent_and_food_paid;
            $dataToUpdate['second_month_rent_and_food_remaining'] = $request->second_month_rent_and_food-$request->second_month_rent_and_food_paid;
            $dataToUpdate['third_month_rent_and_food'] = $request->third_month_rent_and_food;
            $dataToUpdate['third_month_rent_and_food_paid'] = $request->third_month_rent_and_food_paid;
            $dataToUpdate['third_month_rent_and_food_remaining'] = $request->third_month_rent_and_food-$request->third_month_rent_and_food_paid;
            $dataToUpdate['training_1st_and_2nd_month'] = $request->training_1st_and_2nd_month;
            $dataToUpdate['training_1st_and_2nd_month_paid'] = $request->training_1st_and_2nd_month_paid;
            $dataToUpdate['training_1st_and_2nd_month_remaining'] = $request->training_1st_and_2nd_month-$request->training_1st_and_2nd_month_paid;
            $dataToUpdate['phone_loan'] = $request->phone_loan;
            $dataToUpdate['phone_loan_paid'] = $request->phone_loan_paid;
            $dataToUpdate['phone_loan_remaining'] = $request->phone_loan-$request->phone_loan_paid;

            $total_loan=
            $request->services_fees+
            $request->visa_print+
            $request->first_month_rent_and_food+
            $request->commision+
            $request->accomodation_preparation+
            $request->uniform+
            $request->sim_and_photo+
            $request->transportaion+
            $request->medical+
            $request->e_contract+
            $request->qid_issuing+
            $request->health_card+
            $request->school_registration+
            $request->liesence_print+
            $request->second_month_rent_and_food+
            $request->third_month_rent_and_food+
            $request->training_1st_and_2nd_month+
            $request->phone_loan;

            $total_loan_paid=
            $request->services_fees_paid+
            $request->visa_print_paid+
            $request->first_month_rent_and_food_paid+
            $request->commision_paid+
            $request->accomodation_preparation_paid+
            $request->uniform_paid+
            $request->sim_and_photo_paid+
            $request->transportaion_paid+
            $request->medical_paid+
            $request->e_contract_paid+
            $request->qid_issuing_paid+
            $request->health_card_paid+
            $request->school_registration_paid+
            $request->liesence_print_paid+
            $request->second_month_rent_and_food_paid+
            $request->third_month_rent_and_food_paid+
            $request->training_1st_and_2nd_month_paid+
            $request->phone_loan_paid;


            $total_loan_remaining=$total_loan-$total_loan_paid;



            $dataToUpdate['total_loan'] = $total_loan;
            $dataToUpdate['total_loan_paid'] = $total_loan_paid;
            $dataToUpdate['total_loan_remaining'] = $total_loan_remaining;



            $dataToUpdate['updated_by'] = auth()->user()->id;

            update(new GeneralLoan(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('financial.generalLoans_index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }


    public function specialLoans_index(){
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new SpecialLoan(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.financial.specialLoans_index", ['data' => $data]);
    }


    
    public function specialLoans_edit($id){
        $com_code = auth()->user()->com_code;
        $other['employee'] = get_cols_where(new Employee(), array("*"), array("active" => 1,"com_code" => $com_code),'id','ASC');

        $specialLoans = get_cols_where_row(new SpecialLoan(), array("*"), array("id" => $id));
     

        if (empty($specialLoans)) {
        return redirect()->route('financial.specialLoans_index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.financial.specialLoans_edit', ['other' => $other,'specialLoans'=> $specialLoans]);

}

public function specialLoans_create()
{
    $com_code = auth()->user()->com_code;
       // $employee = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code));
        $other['employee'] = get_cols_where(new Employee(), array("*"), array("active" => 1,"com_code" => $com_code),'id','ASC');

        if (empty($other)) {
        return redirect()->route('financial.specialLoans_index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.financial.specialLoans_create', ['other'=>$other]);
}



public function specialLoans_store(Request $request)
{
    try {
       
        DB::beginTransaction();
        
        $DataToInsert['driver_id'] = $request->driver_id;
        $DataToInsert['loan_name'] = $request->loan_name;
        $DataToInsert['loan_value'] = $request->loan_value;
        $DataToInsert['loan_status'] = $request->loan_status;
        if($request->has('loan_image')){
            $request->validate([
                'loan_image'=>'required|mimes:png,jpg,jpeg|max:2000',
            ]);
            $the_file_path=uploadImage('assets/admin/uploads',$request->loan_image);
            $DataToInsert['loan_image']=$the_file_path;
        }
        $DataToInsert['com_code'] = auth()->user()->com_code;        
        $DataToInsert['added_by'] = auth()->user()->id;
        insert(new SpecialLoan(), $DataToInsert);
        DB::commit();
        return redirect()->route('financial.specialLoans_index')->with(['success' => 'تم تحديث البيانات بنجاح']);

    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}




public function specialLoans_update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new SpecialLoan(), array("*"), array('com_code' => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('financial.specialLoans_index')->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }


            DB::beginTransaction();
            $dataToUpdate['driver_id'] = $request->driver_id;
            $dataToUpdate['loan_name'] = $request->loan_name;
            $dataToUpdate['loan_value'] = $request->loan_value;
            $dataToUpdate['loan_status'] = $request->loan_status;
            if($request->has('loan_image')){
                $request->validate([
                    'loan_image'=>'required|mimes:png,jpg,jpeg|max:2000',
                ]);
                $the_file_path=uploadImage('assets/admin/uploads',$request->loan_image);
                $dataToUpdate['loan_image']=$the_file_path;
            }
            $dataToUpdate['updated_by'] = auth()->user()->id;

            update(new SpecialLoan(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('financial.specialLoans_index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
            return view('admin.financial.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.financial.get_centers',['other'=>$other]);
        }
    }
}
