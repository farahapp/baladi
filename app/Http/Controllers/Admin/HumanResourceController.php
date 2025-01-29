<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\HumanResourceResourcest2;
use App\Models\Admin_panel_setting;
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
use App\Models\Residency_process_status;
use App\Models\Shifts_type;
use App\Models\Sponsorship_transfer_status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;

class HumanResourceController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));

        return view("admin.HumanResource.index",['data' => $data,'other'=>$other]);
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
     

        return view("admin.HumanResource.create", ['other' => $other]);
    }

    public function store(HumanResourceResourcest2 $request)
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
            $DataToInsert['baladi_id'] = $request->baladi_id;
            $DataToInsert['nationalities'] = $request->nationalities;
            $DataToInsert['job_type'] = $request->job_type;
            $DataToInsert['delevery_type'] = $request->delevery_type;
            $DataToInsert['appointment_type'] = $request->appointment_type;
            $DataToInsert['branches'] = $request->branches;
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
            return redirect()->route('HumanResource.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
        return redirect()->route('HumanResource.index')->with(['error' => 'عفوا غير قادر علي الوصول الي البيانات المطلوبة']);
        }
        return view('admin.HumanResource.edit', ['data' => $data,'other'=>$other]);

    }





 
        public function update($id, HumanResourceResourcest2 $request)
        {
            try {
                $com_code = auth()->user()->com_code;
                $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $id));
                if (empty($data)) {
                    return redirect()->route('HumanResource.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة !']);
                }

                // $CheckExsists = Employee::select("id")->where('com_code', '=', $com_code)->where('driver_name', '=', $request->driver_name)->where('id', '!=', $id)->first();
                // if (!empty($CheckExsists)) {
                //     return redirect()->back()->with(['error' => 'عفوا اسم السائق مسجل من قبل !'])->withInput();
                // }


                DB::beginTransaction();

                $dataToUpdate['driver_name'] = $request->driver_name;
                $dataToUpdate['driver_english_name'] = $request->driver_english_name;
                $dataToUpdate['baladi_id'] = $request->baladi_id;
                $dataToUpdate['nationalities'] = $request->nationalities;
                $dataToUpdate['job_type'] = $request->job_type;
                $dataToUpdate['delevery_type'] = $request->delevery_type;
                $dataToUpdate['appointment_type'] = $request->appointment_type;
                $dataToUpdate['branches'] = $request->branches;
                $dataToUpdate['contract_type'] = $request->contract_type;
                $dataToUpdate['isVisaPrinted'] = $request->isVisaPrinted;
                if($request->isVisaPrinted==1)
            {
                $dataToUpdate['visa_number'] = $request->visa_number;
                $dataToUpdate['visa_start_date'] = $request->visa_start_date;
                $dataToUpdate['visa_end_date'] = $request->visa_end_date;
            }
               
                if($request->has('visa_image')){


                    $request->validate([
                        'visa_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);

                    $deletePath='assets/admin/uploads/'.$data->visa_image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }

                    $the_file_path=uploadImage('assets/admin/uploads',$request->visa_image);
                    $dataToUpdate['visa_image']=$the_file_path;
                }
                $dataToUpdate['driver_gender'] = $request->driver_gender;
                $dataToUpdate['brith_date'] = $request->brith_date;
                $dataToUpdate['marital_status'] = $request->marital_status;
                if($request->marital_status==1)
                {
                $dataToUpdate['sons_number'] = $request->sons_number;
                }
                $dataToUpdate['driver_pasport_no'] = $request->driver_pasport_no;
                $dataToUpdate['driver_pasport_exp'] = $request->driver_pasport_exp;
                if($request->has('driver_pasport_image')){
                    $request->validate([
                        'driver_pasport_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);

                    $deletePath='assets/admin/uploads/'.$data->driver_pasport_image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }

                    $the_file_path=uploadImage('assets/admin/uploads',$request->driver_pasport_image);
                    $dataToUpdate['driver_pasport_image']=$the_file_path;
                }
                $dataToUpdate['Qualifications_id'] = $request->Qualifications_id;
                $dataToUpdate['driver_sudan_tel'] = $request->driver_sudan_tel;
                $dataToUpdate['sudan_driver_Basic_stay_address'] = $request->sudan_driver_Basic_stay_address;
                
            //     $dataToUpdate['isPostPayInSudan'] = $request->isPostPayInSudan;
            //     if($request->isPostPayInSudan==1)
            // {
            //     $dataToUpdate['post_pay_amount'] = $request->post_pay_amount;
            // }
            //     if($request->has('post_pay_pill_image')){
            //         $request->validate([
            //             'post_pay_pill_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
            //         ]);

            //         $deletePath='assets/admin/uploads/'.$data->post_pay_pill_image;
            //         if(File::exists($deletePath))
            //         {
            //             deleteImage($deletePath);
            //         }

            //         $the_file_path=uploadImage('assets/admin/uploads',$request->post_pay_pill_image);
            //         $dataToUpdate['post_pay_pill_image']=$the_file_path;
            //     }


                $dataToUpdate['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
                
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
                    $dataToUpdate['sudanese_driving_license_Image']=$the_file_path;
                }

                 if($request->has('driver_photo')){
                    $request->validate([
                        'driver_photo'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);
                    $deletePath='assets/admin/uploads/'.$data->driver_photo;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }
                    $the_file_path=uploadImage('assets/admin/uploads',$request->driver_photo);
                    $dataToUpdate['driver_photo']=$the_file_path;
                }
                if($request->arrive_qater_date!=''||$request->arrive_qater_date!=null)
                {
                    $dataToUpdate['arrive_qater_date'] = $request->arrive_qater_date;
                }

                if($request->driver_quater_tel!=''||$request->driver_quater_tel!=null)
                {
                    $dataToUpdate['driver_quater_tel'] = $request->driver_quater_tel;
                }

                if($request->driver_email!=''||$request->driver_email!=null)
                {
                    $dataToUpdate['driver_email'] = $request->driver_email;
                }

                $dataToUpdate['does_has_ateendance'] = $request->does_has_ateendance;
                if($request->ateendance_device_no!=''||$request->ateendance_device_no!=null)
                {
                    $dataToUpdate['ateendance_device_no'] = $request->ateendance_device_no;
                }
                $dataToUpdate['driver_residency_process_status'] = $request->driver_residency_process_status;
                $dataToUpdate['driver_residency_permit_id'] = $request->driver_residency_permit_id;
                $dataToUpdate['driver_end_residencyIDate'] = $request->driver_end_residencyIDate;
                if($request->has('driver_residency_id_Image')){
                    $request->validate([
                        'driver_residency_id_Image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);

                    $deletePath='assets/admin/uploads/'.$data->driver_residency_id_Image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }

                    $the_file_path=uploadImage('assets/admin/uploads',$request->driver_residency_id_Image);
                    $dataToUpdate['driver_residency_id_Image']=$the_file_path;
                }
                $dataToUpdate['driver_bank_process'] = $request->driver_bank_process;
                $dataToUpdate['driver_bank_number'] = $request->driver_bank_number;
                $dataToUpdate['ismedicalinsurance'] = $request->ismedicalinsurance;
                $dataToUpdate['medicalinsuranceNumber'] = $request->medicalinsuranceNumber;
                $dataToUpdate['Functional_status'] = $request->Functional_status;
                if($request->qater_staies_address!=''||$request->qater_staies_address!=null)
                {
                    $dataToUpdate['qater_staies_address'] = $request->qater_staies_address;
                }


                if($request->employer!=''||$request->employer!=null)
                {
                    $dataToUpdate['employer'] = $request->employer;
                }

                if($request->has('no_objection_image')){
                    $request->validate([
                        'no_objection_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);

                    $deletePath='assets/admin/uploads/'.$data->no_objection_image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }

                    $the_file_path=uploadImage('assets/admin/uploads',$request->no_objection_image);
                    $dataToUpdate['driver_residency_id_Image']=$the_file_path;
                }



                if($request->old_qid_number!=''||$request->old_qid_number!=null)
                {
                    $dataToUpdate['old_qid_number'] = $request->old_qid_number;
                }

                if($request->has('old_qid_image')){
                    $request->validate([
                        'old_qid_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                    ]);

                    $deletePath='assets/admin/uploads/'.$data->old_qid_image;
                    if(File::exists($deletePath))
                    {
                        deleteImage($deletePath);
                    }

                    $the_file_path=uploadImage('assets/admin/uploads',$request->old_qid_image);
                    $dataToUpdate['driver_residency_id_Image']=$the_file_path;
                }


                if($request->arrive_qater_date!=''||$request->arrive_qater_date!=null)
                {
                    $dataToUpdate['arrive_qater_date'] = $request->arrive_qater_date;
                }

                
                if($request->sponsorship_transfer_status!=''||$request->sponsorship_transfer_status!=null)
                {
                    $dataToUpdate['sponsorship_transfer_status'] = $request->sponsorship_transfer_status;
                }
               




                if($request->driver_notes!=''||$request->driver_notes!=null)
                {
                    $dataToUpdate['driver_notes'] = $request->driver_notes;
                }

               


                // $dataToUpdate['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
                // $dataToUpdate['sudanese_driving_License_number'] = $request->sudanese_driving_License_number;
                // $dataToUpdate['sudanese_driving_license_types_id'] = $request->sudanese_driving_license_types_id;
                // if($request->has('driver_photo')){
                //     $request->validate([
                //         'driver_photo'=>'required|mimes:png,jpg,jpeg|max:2000',
                //     ]);

                //     $the_file_path=uploadImage('assets/admin/uploads',$request->driver_photo);
                //     $dataToUpdate['driver_photo']=$the_file_path;
                // }


                
                // $dataToUpdate['active'] = $request->active;
                $dataToUpdate['updated_by'] = auth()->user()->id;
                update(new Employee(), $dataToUpdate, array('com_code' => $com_code, 'id' => $id));
                DB::commit();
                return redirect()->route('HumanResource.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
            return view('admin.HumanResource.get_governorates',['other'=>$other]);
        }
    }

    public function get_centers(Request $request)
    {
        if ($request->ajax()) {
            $governorates_id = $request->governorates_id;
            $other['centers'] = get_cols_where(new centers(), array("id", "name"), array("com_code" => auth()->user()->com_code, 'governorates_id' => $governorates_id));
            return view('admin.HumanResource.get_centers',['other'=>$other]);
        }
    }

    

    public function GovernmentProcess()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
         
        $other['residency_process_status'] = get_cols_where(new Residency_process_status(), array("id", "name"), array("active" => 1),'id','ASC');
        $other['driver_bank_process'] = get_cols_where(new Driver_bank_process(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.HumanResource.GovernmentProcess', ['data' => $data,'other'=>$other]);
  
    }


    /////////////////////////////////////////////////////////////////////////////
public function ajax_update_driver_residency_process_status(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['driver_residency_process_status']=$request->driver_residency_process_status;
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
public function ajax_update_driver_bank_process(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['driver_bank_process']=$request->driver_bank_process;
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
public function ajax_search(Request $request)
{
    if ($request->ajax()) {
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $search_by_operating_company = $request->search_by_operating_company;
        $year = $request->year;
        $months = $request->months;
        
        if ($search_by_text != '') {
            if($searchbyradio == 'name'){
                $field1 = "driver_name";
                $operator1 = "like";
                $value1 = "%{$search_by_text}%";
            }elseif($searchbyradio == 'baladi_id'){
                $field1 = "baladi_id";
                $operator1 = "like";
                $value1 = "%{$search_by_text}%";
            }else{
                $field1 = "driver_quater_tel";
                $operator1 = "like";
                $value1 = "%{$search_by_text}%";
            }
        }else{
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        }
        if ($year == 'all' && $months == '') {
            //هنا نعمل شرط دائم التحقق
            // $field2 = "id";
            // $operator2 = "!=";
            // $value2 = 0;
            $data = Employee::select("*")->where($field1, $operator1, $value1)->orderby('id', 'ASC')->paginate(PC);
        } 
        if ($year != 'all' && $months == '') {
            $field2 = "driver_end_residencyIDate";
            $operator2 = "=";
            $value2 = $year;
            $data = Employee::select("*")->where($field1, $operator1, $value1)->whereYear( $field2, $operator2, $value2)->orderby('id', 'ASC')->paginate(PC);
        }
        if ($year == 'all' && $months != '') {
            //هنا نعمل شرط دائم التحقق
            // $field3 = "driver_end_residencyIDate";
            // $operator3 = "!=";
            // $value3 = 0;
            $data = Employee::select("*")->where($field1, $operator1, $value1)->whereIn(DB::raw('MONTH(driver_end_residencyIDate)'), $months)->orderby('id', 'ASC')->paginate(PC);
        } if ($year != 'all' && $months != '') {
            $field2 = "driver_end_residencyIDate";
            $operator2 = "=";
            $value2 = $year;
            $data = Employee::select("*")->where($field1, $operator1, $value1)->whereYear( $field2, $operator2, $value2)->whereIn(DB::raw('MONTH(driver_end_residencyIDate)'), $months)->orderby('id', 'ASC')->paginate(PC);
        }
      
       // $data = Employee::select("*")->where($field1, $operator1, $value1)->whereYear( $field2, $operator2, $value2)->whereMonth($field3,$operator3,$value3)->orderby('id', 'ASC')->paginate(PC);
     //   $data = Employee::select("*")->where($field1, $operator1, $value1)->orderby('id', 'ASC')->paginate(PC);
        //$data = Employee::select("*")->where($field1, $operator1, $value1)->whereIn(DB::raw('MONTH(driver_end_residencyIDate)'), $months)->orderby('id', 'ASC')->paginate(PC);
       
        return view('admin.HumanResource.ajax_search', ['data' => $data]);
  
        }
}
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

        return view('admin.HumanResource.ajax_search_GovernmentProcess', ['data' => $data,'other'=>$other]);
  
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


        return view('admin.HumanResource.print_GovernmentProcess_search', ['data' => $data,'other'=>$other,'systemData'=>$systemData]);
  
        
}
/////////////////////////////////////////////////////////////////////////////

}
