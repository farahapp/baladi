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

class EmployeesController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        return view("admin.Employees.index", ['data' => $data]);
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

        return view("admin.Employees.create", ['other' => $other]);
    }

    public function store(Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
           
            $CheckExsists = get_cols_where_row(new Employee(), array("id"), array("com_code" => $com_code,'driver_name' => $request->driver_name));
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            $Checkemail = get_cols_where_row(new Employee(), array("id"), array("com_code" => $com_code, 'driver_email' => $request->driver_email));
            if (!empty($Checkemail)) {
                return redirect()->back()->with(['error' => 'عفوا البريد الالكتروني مسجل من قبل '])->withInput();
            }else{


            DB::beginTransaction();

            $DataToInsert['driver_name'] = $request->driver_name;
            $DataToInsert['appointment_type'] = $request->appointment_type;
            $DataToInsert['contract_type'] = $request->contract_type;
            $DataToInsert['isSigningInitialContract'] = $request->isSigningInitialContract;
            if($request->isSigningInitialContract==1)
            {
            $DataToInsert['initial_contract_image'] = $request->initial_contract_image;
            }
            $DataToInsert['isVisaPrinted'] = $request->isVisaPrinted;
            if($request->isVisaPrinted==1)
            {
                $DataToInsert['visa_number'] = $request->visa_number;
                $DataToInsert['visa_start_date'] = $request->visa_start_date;
                $DataToInsert['visa_end_date'] = $request->visa_end_date;
                $DataToInsert['visa_image'] = $request->visa_image;
            }
            $DataToInsert['driver_gender'] = $request->driver_gender;
            $DataToInsert['brith_date'] = $request->brith_date;
            $DataToInsert['marital_status'] = $request->marital_status;
            if($request->marital_status==1)
            {
            $DataToInsert['sons_number'] = $request->sons_number;
            }
            $DataToInsert['driver_pasport_no'] = $request->driver_pasport_no;
            $DataToInsert['driver_pasport_from'] = $request->driver_pasport_from;
            $DataToInsert['driver_pasport_exp'] = $request->driver_pasport_exp;
            $DataToInsert['driver_pasport_image'] = $request->driver_pasport_image;
            $DataToInsert['Qualifications_id'] = $request->Qualifications_id;
            $DataToInsert['driver_sudan_tel'] = $request->driver_sudan_tel;
            $DataToInsert['sudan_driver_Basic_stay_address'] = $request->sudan_driver_Basic_stay_address;
            $DataToInsert['isPostPayInSudan'] = $request->isPostPayInSudan;
            if($request->isPostPayInSudan==1)
            {
                $DataToInsert['post_pay_amount'] = $request->post_pay_amount;
                $DataToInsert['post_pay_pill_image'] = $request->post_pay_pill_image;
            }
            $DataToInsert['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
            if($request->does_has_sudanese_Driving_License==1)
            {
                $DataToInsert['sudanese_driving_License_number'] = $request->sudanese_driving_License_number;
                $DataToInsert['sudanese_driving_license_types_id'] = $request->sudanese_driving_license_types_id;
                $DataToInsert['sudanese_driving_license_Image'] = $request->sudanese_driving_license_Image;
            }
            $DataToInsert['driver_photo'] = $request->driver_photo;
            $DataToInsert['arrive_qater_date'] = $request->arrive_qater_date;
            $DataToInsert['isGivePassPort'] = $request->isGivePassPort;
            if($request->isGivePassPort==1)
            {
                $DataToInsert['give_passport_image'] = $request->give_passport_image;
            }
            $DataToInsert['isSigningFullFinancialDebt'] = $request->isSigningFullFinancialDebt;
            if($request->isSigningFullFinancialDebt==1)
            {
                $DataToInsert['SigningFullFinancialDebt_Image'] = $request->SigningFullFinancialDebt_Image;
            }
            $DataToInsert['isSigningPenaltyClause'] = $request->isSigningPenaltyClause;
            if($request->isSigningPenaltyClause==1)
            {
                $DataToInsert['isSigningPenaltyClause_Image'] = $request->isSigningPenaltyClause_Image;
            }
            $DataToInsert['uniform_status'] = $request->uniform_status;
            $DataToInsert['driver_quater_tel'] = $request->driver_quater_tel;
            $DataToInsert['driver_email'] = $request->driver_email;
            $DataToInsert['Functional_status'] = $request->Functional_status;
            $DataToInsert['does_has_ateendance'] = $request->does_has_ateendance;
            $DataToInsert['driver_residency_process_status'] = $request->driver_residency_process_status;
            if($request->driver_residency_process_status==1)
            {
                $DataToInsert['driver_residency_permit_id'] = $request->driver_residency_permit_id;
            }
            $DataToInsert['driver_end_residencyIDate'] = $request->driver_end_residencyIDate;
            $DataToInsert['driver_residency_id_Image'] = $request->driver_residency_id_Image;
            $DataToInsert['driver_bank_process'] = $request->driver_bank_process;
            if($request->driver_bank_process==1)
            {
                $DataToInsert['driver_bank_number'] = $request->driver_bank_number;
            }
            $DataToInsert['driving_school_status'] = $request->driving_school_status;
            if($request->driving_school_status==1)
            {
                $DataToInsert['driving_permit_number'] = $request->driving_permit_number;
                $DataToInsert['driving_permit_image'] = $request->driving_permit_image;
            }
            $DataToInsert['ismedicalinsurance'] = $request->ismedicalinsurance;
            if($request->ismedicalinsurance==1)
            {
                $DataToInsert['medicalinsuranceNumber'] = $request->medicalinsuranceNumber;
            }
            $DataToInsert['qater_staies_address'] = $request->qater_staies_address;
            $DataToInsert['driver_notes'] = $request->driver_notes;
            /////////////////////////////////////////////////////////////////////////
            $DataToInsert['com_code'] = auth()->user()->com_code;        
            $DataToInsert['active'] = 1;        
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Employee(), $DataToInsert);
            DB::commit();
            return redirect()->route('Employees.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        }
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
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
}
