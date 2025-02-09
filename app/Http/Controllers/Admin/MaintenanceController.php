<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\permission_sub_menuesRequst;
use App\Models\Branche;
use App\Models\Employee;
use App\Models\Permission_main_menues;
use App\Models\Permission_sub_menues;
use App\Models\Permission_sub_menues_actions;
use App\Models\Vechile_Information;
use App\Models\Vechile_Model;
use App\Models\Vechile_Spare_Parts;
use App\Models\Vechile_Traffic_Violations;
use App\Models\Vechile_Type;
use App\Models\vechileAccidentPart;
use App\Models\Vehicle_Maintenance;
use App\Models\VehicleAccident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class MaintenanceController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
       // $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data = get_cols_where_p(new Vechile_Information(), array("*"), array("com_code" => $com_code,"vechile_car_or_bike"=>1), 'id', 'ASC', PC);
        $vehicle_Maintenance = get_cols_where(new Vehicle_Maintenance(), array("*"), array("com_code" => $com_code));
        $Vechile_Spare_Parts = get_cols_where(new Vechile_Spare_Parts(), array("*"), array("com_code" => $com_code));


       // $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code,"vechile_car_or_bike"=>1));
        $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code));

        return view('admin.Maintenance.index', ['data' => $data,'vehicle_Maintenance'=>$vehicle_Maintenance,'Vechile_Spare_Parts'=>$Vechile_Spare_Parts,'Vechile_Model'=>$Vechile_Model]);
    }

    public function create()
    {
        $com_code = auth()->user()->com_code;
        $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data['Vechile_Type'] = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $data['Vechile_Model'] = get_cols_where_p(new Vechile_Model(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $data['Employee'] = get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");
        $data['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));

        $com_code = auth()->user()->com_code;
        return view('admin.Maintenance.create', ['data' => $data]);
    }

    public function store(Request $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Information(), array("id"), array("com_code" => $com_code, 'vechile_no' => $request->vechile_no));
            if (!empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['vechile_car_or_bike'] = 1;
            $DataToInsert['vechile_no'] = $request->vechile_no;
            $DataToInsert['branches'] = $request->branches;
            $DataToInsert['vechile_type'] = $request->vechile_type;
            $DataToInsert['vechile_model'] = $request->vechile_model;
            $DataToInsert['vechile_color'] = $request->vechile_color;
            $DataToInsert['vechile_end_registeration'] = $request->vechile_end_registeration;
            $DataToInsert['insurance_company'] = $request->insurance_company;
            $DataToInsert['insurance_ending_date'] = $request->insurance_ending_date;
            $DataToInsert['insurance_type'] = $request->insurance_type;
            $DataToInsert['vechile_driver'] = $request->vechile_driver;

            if($request->has('vechile_registeration_image')){
                $request->validate([
                    'vechile_registeration_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                // $deletePath='assets/admin/uploads/'.$data->vechile_registeration_image;
                // if(File::exists($deletePath))
                // {
                //     deleteImage($deletePath);
                // }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_registeration_image);
                $DataToInsert['vechile_registeration_image']=$the_file_path;
            }

            if($request->has('vechile_image')){
                $request->validate([
                    'vechile_image'=>'required|mimes:jpg,pdf,png,jpeg|max:2000',
                ]);

                // $deletePath='assets/admin/uploads/'.$data->vechile_image;
                // if(File::exists($deletePath))
                // {
                //     deleteImage($deletePath);
                // }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_image);
                $DataToInsert['vechile_image']=$the_file_path;
            }

            $DataToInsert['vechile_status'] = $request->vechile_status;
            $DataToInsert['maintenance_notes'] = $request->maintenance_notes;
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Vechile_Information(), $DataToInsert);
            DB::commit();
            return redirect()->route('Maintenance.index')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit($id)
    {

        $com_code = auth()->user()->com_code;
        // $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data['Employee'] = get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");
        $data['Vechile_Type'] = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        $data['Vechile_Model'] = get_cols_where_p(new Vechile_Model(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        $data['Vechile_Information'] = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $id));
        $data['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        if (empty($data)) {
            return redirect()->route('Maintenance.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Maintenance.edit', ['data' => $data]);
    }

    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Maintenance.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Vechile_Information::select("id")->where("com_code", "=", $com_code)->where("vechile_no", "=", $request->vechile_no)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['vechile_no'] = $request->vechile_no;
            $DataToUpdate['branches'] = $request->branches;
            $DataToUpdate['vechile_type'] = $request->vechile_type;
            $DataToUpdate['vechile_model'] = $request->vechile_model;
            $DataToUpdate['vechile_color'] = $request->vechile_color;
            $DataToUpdate['vechile_end_registeration'] = $request->vechile_end_registeration;
            $DataToUpdate['insurance_company'] = $request->insurance_company;
            $DataToUpdate['insurance_ending_date'] = $request->insurance_ending_date;
            $DataToUpdate['insurance_type'] = $request->insurance_type;
            $DataToUpdate['vechile_driver'] = $request->vechile_driver;

            if($request->has('vechile_registeration_image')){
                $request->validate([
                    'vechile_registeration_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->vechile_registeration_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_registeration_image);
                $DataToUpdate['vechile_registeration_image']=$the_file_path;
            }

            if($request->has('vechile_image')){
                $request->validate([
                    'vechile_image'=>'required|mimes:jpg,pdf,png,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->vechile_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_image);
                $DataToUpdate['vechile_image']=$the_file_path;
            }
            
            $DataToUpdate['vechile_status'] = $request->vechile_status;
            $DataToUpdate['maintenance_notes'] = $request->maintenance_notes;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Vechile_Information(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Maintenance.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Information(), array("id"), array('id' => $id));
            if (empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Vechile_Information(), array('id' => $id));
            DB::commit();
            return redirect()->back()->with(['success' => 'Data deleted successfully']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
        }
    }

    public function index_bike()
    {
        $com_code = auth()->user()->com_code;
       // $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data = get_cols_where_p(new Vechile_Information(), array("*"), array("com_code" => $com_code,"vechile_car_or_bike"=>2), 'id', 'ASC', PC);
        $vehicle_Maintenance = get_cols_where(new Vehicle_Maintenance(), array("*"), array("com_code" => $com_code));
        $Vechile_Spare_Parts = get_cols_where(new Vechile_Spare_Parts(), array("*"), array("com_code" => $com_code));


        $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code));

        return view('admin.Maintenance.index_bike', ['data' => $data,'vehicle_Maintenance'=>$vehicle_Maintenance,'Vechile_Spare_Parts'=>$Vechile_Spare_Parts,'Vechile_Model'=>$Vechile_Model]);
    }

    public function create_bike()
    {
        $com_code = auth()->user()->com_code;
        $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data['Vechile_Type'] = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $data['Vechile_Model'] = get_cols_where_p(new Vechile_Model(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        $data['Employee'] = get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");
        $data['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $com_code = auth()->user()->com_code;
        return view('admin.Maintenance.create_bike', ['data' => $data]);
    }

    public function store_bike(Request $request)
    {
        try {

            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Information(), array("id"), array("com_code" => $com_code, 'vechile_no' => $request->vechile_no));
            if (!empty($data)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToInsert['vechile_car_or_bike'] = 2;
            $DataToInsert['vechile_no'] = $request->vechile_no;
            $DataToInsert['branches'] = $request->branches;
            $DataToInsert['vechile_type'] = $request->vechile_type;
            $DataToInsert['vechile_model'] = $request->vechile_model;
            $DataToInsert['vechile_color'] = $request->vechile_color;
            $DataToInsert['vechile_end_registeration'] = $request->vechile_end_registeration;
            $DataToInsert['insurance_company'] = $request->insurance_company;
            $DataToInsert['insurance_ending_date'] = $request->insurance_ending_date;
            $DataToInsert['insurance_type'] = $request->insurance_type;
            $DataToInsert['vechile_driver'] = $request->vechile_driver;

            if($request->has('vechile_registeration_image')){
                $request->validate([
                    'vechile_registeration_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                // $deletePath='assets/admin/uploads/'.$data->vechile_registeration_image;
                // if(File::exists($deletePath))
                // {
                //     deleteImage($deletePath);
                // }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_registeration_image);
                $DataToInsert['vechile_registeration_image']=$the_file_path;
            }

            if($request->has('vechile_image')){
                $request->validate([
                    'vechile_image'=>'required|mimes:jpg,pdf,png,jpeg|max:2000',
                ]);

                // $deletePath='assets/admin/uploads/'.$data->vechile_image;
                // if(File::exists($deletePath))
                // {
                //     deleteImage($deletePath);
                // }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_image);
                $DataToInsert['vechile_image']=$the_file_path;
            }

            $DataToInsert['vechile_status'] = $request->vechile_status;
            $DataToInsert['maintenance_notes'] = $request->maintenance_notes;
            $DataToInsert['com_code'] = $com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Vechile_Information(), $DataToInsert);
            DB::commit();
            return redirect()->route('Maintenance.index_bike')->with(['success' => 'تم تسجيل البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا  حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

    public function edit_bike($id)
    {

        $com_code = auth()->user()->com_code;
        // $data['Permission_main_menuesData'] = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        $data['Employee'] = get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");
        $data['Vechile_Type'] = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        $data['Vechile_Model'] = get_cols_where_p(new Vechile_Model(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        $data['Vechile_Information'] = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $id));
        $data['branches'] = get_cols_where(new Branche(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
        if (empty($data)) {
            return redirect()->route('Maintenance.index_bike')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        return view('admin.Maintenance.edit_bike', ['data' => $data]);
    }

    public function update_bike($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $id));
            if (empty($data)) {
                return redirect()->route('Maintenance.index_bike')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
            }
            $CheckExsists = Vechile_Information::select("id")->where("com_code", "=", $com_code)->where("vechile_no", "=", $request->vechile_no)->where('id', '!=', $id)->first();
            if (!empty($CheckExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['vechile_no'] = $request->vechile_no;
            $DataToUpdate['branches'] = $request->branches;
            $DataToUpdate['vechile_type'] = $request->vechile_type;
            $DataToUpdate['vechile_model'] = $request->vechile_model;
            $DataToUpdate['vechile_color'] = $request->vechile_color;
            $DataToUpdate['vechile_end_registeration'] = $request->vechile_end_registeration;
            $DataToUpdate['insurance_company'] = $request->insurance_company;
            $DataToUpdate['insurance_ending_date'] = $request->insurance_ending_date;
            $DataToUpdate['insurance_type'] = $request->insurance_type;
            $DataToUpdate['vechile_driver'] = $request->vechile_driver;

            if($request->has('vechile_registeration_image')){
                $request->validate([
                    'vechile_registeration_image'=>'required|mimes:pdf,png,jpg,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->vechile_registeration_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_registeration_image);
                $DataToUpdate['vechile_registeration_image']=$the_file_path;
            }

            if($request->has('vechile_image')){
                $request->validate([
                    'vechile_image'=>'required|mimes:jpg,pdf,png,jpeg|max:2000',
                ]);

                $deletePath='assets/admin/uploads/'.$data->vechile_image;
                if(File::exists($deletePath))
                {
                    deleteImage($deletePath);
                }
                
                $the_file_path=uploadImage('assets/admin/uploads',$request->vechile_image);
                $DataToUpdate['vechile_image']=$the_file_path;
            }
            
            $DataToUpdate['vechile_status'] = $request->vechile_status;
            $DataToUpdate['maintenance_notes'] = $request->maintenance_notes;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Vechile_Information(), $DataToUpdate, array("com_code" => $com_code, 'id' => $id));
            DB::commit();
            return redirect()->route('Maintenance.index_bike')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
        }
    }

     // ====================================================================
     public function load_add_maintenance_to_vehicle(Request $request){
        if($request->ajax()){
            $com_code=auth()->user()->com_code;
            $Vechile_Information=get_cols_where_row(new Vechile_Information(),array("*"),array("id"=>$request->id,"com_code"=>$com_code));

           
           // echo $permission_roles_main_menus['permission_main_menues_id'];
            return view('admin.Maintenance.load_add_maintenance_to_vehicle',['Vechile_Information'=>$Vechile_Information]);
      }
    }
// ==================================================================================

// ==================================================================================
 
public function add_maintenance_to_vehicle($Vechile_Information_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $Vechile_Information_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
    
        $DataToInsert['name']=$request->name;
        $DataToInsert['net_cost']=$request->net_cost;
        $DataToInsert['total_cost']=$request->total_cost;
        $DataToInsert['date']=$request->date;
        $DataToInsert['workshop']=$request->workshop;
        $DataToInsert['technician']=$request->technician;
        $DataToInsert['maintenance_notes']=$request->maintenance_notes;
        $DataToInsert['vehicle_id']=$Vechile_Information_id;
            $CheckExsists=get_cols_where_row(new Vehicle_Maintenance(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['com_code']=auth()->user()->com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Vehicle_Maintenance(), $DataToInsert);
            DB::commit();
        }   
        
        return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================

 // =========================================================================
 public function delete_maintenance_to_vehicle($id)
 {
     try {
         $com_code = auth()->user()->com_code;
         $data = get_cols_where_row(new Vehicle_Maintenance(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new Vehicle_Maintenance(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================
  // ====================================================================
  public function load_add_vechile_spare_part(Request $request){
    if($request->ajax()){
        $com_code=auth()->user()->com_code;
        $Vehicle_Maintenance=get_cols_where_row(new Vehicle_Maintenance(),array("*"),array("id"=>$request->id,"com_code"=>$com_code));

       
       // echo $permission_roles_main_menus['permission_main_menues_id'];
        return view('admin.Maintenance.load_add_vechile_spare_part',['Vehicle_Maintenance'=>$Vehicle_Maintenance]);
  }
}
// ==================================================================================
// ==================================================================================
 
public function add_vechile_spare_part($Vehicle_Maintenance_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Vehicle_Maintenance(), array("*"), array("com_code" => $com_code, 'id' => $Vehicle_Maintenance_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
    
        $DataToInsert['name']=$request->name;
        $DataToInsert['price']=$request->price;
        $DataToInsert['vechile_maintenance_id']=$Vehicle_Maintenance_id;
            $CheckExsists=get_cols_where_row(new Vechile_Spare_Parts(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['com_code']=auth()->user()->com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Vechile_Spare_Parts(), $DataToInsert);
            DB::commit();
        }   
        
        return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================


 // =========================================================================
 public function delete_vechile_spare_part($id)
 {
     try {
         $data = get_cols_where_row(new Vechile_Spare_Parts(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new Vechile_Spare_Parts(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================



 public function index_traffic_violations()
 {
     $com_code = auth()->user()->com_code;
    // $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
    $data = get_cols_where_p(new Vechile_Information(), array("*"), array("com_code" => $com_code), 'id', 'ASC', PC);
    $vechile_Traffic_Violations = get_cols_where(new Vechile_Traffic_Violations(), array("*"), array("com_code" => $com_code));


    $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code));

     return view('admin.Maintenance.index_traffic_violations', ['data' => $data,'vechile_Traffic_Violations'=>$vechile_Traffic_Violations,'Vechile_Model'=>$Vechile_Model]);
 }


 // ====================================================================

   // ====================================================================
   public function load_add_traffic_violation(Request $request){
    if($request->ajax()){
        $com_code=auth()->user()->com_code;
        $Vechile_Information=get_cols_where_row(new Vechile_Information(),array("*"),array("id"=>$request->id,"com_code"=>$com_code));
        $drivers= get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");

       // echo $permission_roles_main_menus['permission_main_menues_id'];
        return view('admin.Maintenance.load_add_traffic_violation',['Vechile_Information'=>$Vechile_Information,'drivers'=>$drivers]);
  }
}
// ==================================================================================

// ==================================================================================
 
public function add_traffic_violation($Vechile_Information_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $Vechile_Information_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
    
        $DataToInsert['vechile_driver']=$request->vechile_driver;
        $DataToInsert['traffic_violation_name']=$request->traffic_violation_name;
        $DataToInsert['traffic_violation_amount']=$request->traffic_violation_amount;
        $DataToInsert['date']=$request->date;
        $DataToInsert['traffic_violation_payment_status']=$request->traffic_violation_payment_status;
        $DataToInsert['vechile_id']=$Vechile_Information_id;
            $CheckExsists=get_cols_where_row(new Vechile_Traffic_Violations(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['com_code']=auth()->user()->com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new Vechile_Traffic_Violations(), $DataToInsert);
            DB::commit();
        }   
        
        return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================

public function index_traffic_accidents()
{
    $com_code = auth()->user()->com_code;
   // $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
    $data = get_cols_where_p(new Vechile_Information(), array("*"), array("com_code" => $com_code,"vechile_car_or_bike"=>1), 'id', 'ASC', PC);
    $Vechile_Accidents = get_cols_where(new VehicleAccident(), array("*"), array("com_code" => $com_code));
    $Vechile_Accident_Parts = get_cols_where(new vechileAccidentPart(), array("*"), array("com_code" => $com_code));


   // $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code,"vechile_car_or_bike"=>1));
    $Vechile_Model = get_cols_where(new Vechile_Model(), array("*"), array("com_code" => $com_code));

    return view('admin.Maintenance.index_traffic_accidents', ['data' => $data,'Vechile_Accidents'=>$Vechile_Accidents,'Vechile_Accident_Parts'=>$Vechile_Accident_Parts,'Vechile_Model'=>$Vechile_Model]);
}

// ===============================================================
 // ====================================================================
 public function ajax_load_add_traffic_accidents(Request $request){
    if($request->ajax()){
        $com_code=auth()->user()->com_code;
        $Vechile_Information=get_cols_where_row(new Vechile_Information(),array("*"),array("id"=>$request->id,"com_code"=>$com_code));
        $drivers= get_cols_where(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC");

       
       
       // echo $permission_roles_main_menus['permission_main_menues_id'];
        return view('admin.Maintenance.load_add_traffic_accident',['Vechile_Information'=>$Vechile_Information,'drivers'=>$drivers]);
  }
}
// ==================================================================================
public function add_traffic_accident($Vechile_Information_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Vechile_Information(), array("*"), array("com_code" => $com_code, 'id' => $Vechile_Information_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
        
        $DataToInsert['vechile_driver']=$request->vechile_driver;
        $DataToInsert['place']=$request->place;
        $DataToInsert['fault_person']=$request->fault_person;
        $DataToInsert['date']=$request->date;
        $DataToInsert['description']=$request->description;
        $DataToInsert['vehicle_id']=$Vechile_Information_id;
            $CheckExsists=get_cols_where_row(new VehicleAccident(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['com_code']=auth()->user()->com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new VehicleAccident(), $DataToInsert);
            DB::commit();
        }   
        
        return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================
// =========================================================================
public function delete_traffic_accident($id)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new VehicleAccident(), array("id"), array('id' => $id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
        }
        DB::beginTransaction();
        destroy(new VehicleAccident(), array('id' => $id));
        DB::commit();
        return redirect()->back()->with(['success' => 'Data deleted successfully']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
    }
}
// ====================================================================

 // ====================================================================
 public function load_add_traffic_accident_parts(Request $request){
    if($request->ajax()){
        $com_code=auth()->user()->com_code;
        $VehicleAccident=get_cols_where_row(new VehicleAccident(),array("*"),array("id"=>$request->id,"com_code"=>$com_code));

       
       // echo $permission_roles_main_menus['permission_main_menues_id'];
        return view('admin.Maintenance.load_add_traffic_accident_parts',['VehicleAccident'=>$VehicleAccident]);
  }
}
// ==================================================================================
// ==================================================================================
 
public function add_traffic_accident_parts($VehicleAccident_id,Request $request)
{
    try {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new VehicleAccident(), array("*"), array("com_code" => $com_code, 'id' => $VehicleAccident_id));
        if (empty($data)) {
            return redirect()->back()->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة']);
        }
    
        $DataToInsert['name']=$request->name;
        $DataToInsert['price']=$request->price;
        $DataToInsert['vechile_accident_id']=$VehicleAccident_id;
            $CheckExsists=get_cols_where_row(new vechileAccidentPart(),array("id"),$DataToInsert);
        if (empty($CheckExsists)) {
            DB::beginTransaction();
            $DataToInsert['com_code']=auth()->user()->com_code;
            $DataToInsert['added_by'] = auth()->user()->id;
            insert(new vechileAccidentPart(), $DataToInsert);
            DB::commit();
        }   
        
        return redirect()->back()->with(['success' => 'تم إضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
        DB::rollBack();
        return redirect()->back()->with(['error' => 'عفوا حدث خطأ  ' . $ex->getMessage()])->withInput();
    }
}

// ===============================================================


 // =========================================================================
 public function delete_traffic_accident_part($id)
 {
     try {
         $data = get_cols_where_row(new vechileAccidentPart(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new vechileAccidentPart(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================


 public function index_car_drivers()
 {
     $com_code = auth()->user()->com_code;
     // $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
    
    
     // $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '2'), "id", "ASC", PC);
     $other['vechile_information'] = get_cols_where(new Vechile_Information(), array("*"),  array("com_code" => $com_code),'id','ASC');
     $other['vechile_model'] = get_cols_where(new Vechile_Model(), array("*"),  array("com_code" => $com_code),'id','ASC');


     $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code,"Functional_status" => '2'), "id", "ASC", PC);

     //dd($data);


     return view("admin.Maintenance.index_car_drivers",['data' => $data,'other'=>$other]);
 }
 


    public function ajax_search(Request $request)
    {
        if ($request->ajax()) {
            $searchbyradio = $request->searchbyradio;
            $search_by_text = $request->search_by_text;
            $vechile_model = $request->vechile_model;
            $vechile_status = $request->vechile_status;
           

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
                    $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where("vechile_car_or_bike","=",1)->orderby('id', 'ASC')->paginate(PC);
                }elseif($searchbyradio == 'vechile_driver'){
                    $field3 = "driver_name";
                    $operator3 = "like";
                    $value3 = "%{$search_by_text}%";
                    $employee_id=Employee::select("id")->where($field3, $operator3, $value3);
                    $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->whereIn('vechile_driver',$employee_id)->where("vechile_car_or_bike","=",1)->orderby('id', 'ASC')->paginate(PC);
                }
            }else{
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
                $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("vechile_car_or_bike","=",1)->orderby('id', 'ASC')->paginate(PC);
            }

            $com_code = auth()->user()->com_code;


            $vehicle_Maintenance = get_cols_where(new Vehicle_Maintenance(), array("*"), array("com_code" => $com_code));
            $Vechile_Spare_Parts = get_cols_where(new Vechile_Spare_Parts(), array("*"), array("com_code" => $com_code));
    
            return view('admin.Maintenance.ajax_search',  ['data' => $data,'vehicle_Maintenance'=>$vehicle_Maintenance,'Vechile_Spare_Parts'=>$Vechile_Spare_Parts]);
        }
    }

    //============================================================================================
    
    public function ajax_search_bike(Request $request)
    {
        if ($request->ajax()) {
            $searchbyradio = $request->searchbyradio;
            $search_by_text = $request->search_by_text;
            $vechile_model = $request->vechile_model;
            $vechile_status = $request->vechile_status;
           

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
                    $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where("vechile_car_or_bike","=",2)->orderby('id', 'ASC')->paginate(PC);
                }elseif($searchbyradio == 'vechile_driver'){
                    $field3 = "driver_name";
                    $operator3 = "like";
                    $value3 = "%{$search_by_text}%";
                    $employee_id=Employee::select("id")->where($field3, $operator3, $value3);
                    $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->whereIn('vechile_driver',$employee_id)->where("vechile_car_or_bike","=",2)->orderby('id', 'ASC')->paginate(PC);
                }
            }else{
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
                $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where("vechile_car_or_bike","=",2)->orderby('id', 'ASC')->paginate(PC);
            }

            $com_code = auth()->user()->com_code;


            $vehicle_Maintenance = get_cols_where(new Vehicle_Maintenance(), array("*"), array("com_code" => $com_code));
            $Vechile_Spare_Parts = get_cols_where(new Vechile_Spare_Parts(), array("*"), array("com_code" => $com_code));
    
            return view('admin.Maintenance.ajax_search_bike',  ['data' => $data,'vehicle_Maintenance'=>$vehicle_Maintenance,'Vechile_Spare_Parts'=>$Vechile_Spare_Parts]);
        }
    }

    //=============================================================================================
 //============================================================================================
    
//  public function ajax_search_traffic_violations(Request $request)
//  {
//      if ($request->ajax()) {
//          $searchbyradio = $request->searchbyradio;
//          $search_by_text = $request->search_by_text;
//          $vechile_car_or_bike_search = $request->vechile_car_or_bike_search;
//          $vechile_model = $request->vechile_model;
//          $vechile_status = $request->vechile_status;
        

//          if ($vechile_car_or_bike_search == 'all') {
//              //هنا نعمل شرط دائم التحقق
//              $field1 = "id";
//              $operator1 = ">";
//              $value1 = 0;
//          } else {
//              $field1 = "vechile_car_or_bike";
//              $operator1 = "=";
//              $value1 = $vechile_car_or_bike_search;
//          }
//          if ($vechile_model == 'all') {
//             //هنا نعمل شرط دائم التحقق
//             $field2 = "id";
//             $operator2 = ">";
//             $value2 = 0;
//         } else {
//             $field2 = "vechile_model";
//             $operator2 = "=";
//             $value2 = $vechile_model;
//         }
//          if ($vechile_status == 'all') {
//              //هنا نعمل شرط دائم التحقق
//              $field3 = "id";
//              $operator3 = ">";
//              $value3 = 0;
//          } else {
//              $field3 = "vechile_status";
//              $operator3 = "=";
//              $value3 = $vechile_status;
//          }
//          if ($search_by_text != '') {
//              if($searchbyradio == 'vechile_no'){
//                  $field4 = "vechile_no";
//                  $operator4 = "like";
//                  $value4 = "%{$search_by_text}%";
//                  $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
//              }elseif($searchbyradio == 'vechile_driver'){
//                  $field4 = "driver_name";
//                  $operator4 = "like";
//                  $value4 = "%{$search_by_text}%";
//                  $employee_id=Employee::select("id")->where($field4, $operator4, $value4);
//                  $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->whereIn('vechile_driver',$employee_id)->orderby('id', 'ASC')->paginate(PC);
//              }
//          }else{
//              $field4 = "id";
//              $operator4 = ">";
//              $value4 = 0;
//              $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'ASC')->paginate(PC);
//          }

//          $com_code = auth()->user()->com_code;
         

//          $vechile_Traffic_Violations = get_cols_where(new Vechile_Traffic_Violations(), array("*"), array("com_code" => $com_code));

//          return view('admin.Maintenance.ajax_search_bike',  ['data' => $data,'vechile_Traffic_Violations'=>$vechile_Traffic_Violations]);
//      }
//  }

public function ajax_search_traffic_violations(Request $request)
{
    if ($request->ajax()) {
        $searchbyradio = $request->searchbyradio;
        $search_by_text = $request->search_by_text;
        $vechile_car_or_bike = $request->vechile_car_or_bike;
        $vechile_model = $request->vechile_model;
        $vechile_status = $request->vechile_status;
       

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
                $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
            }elseif($searchbyradio == 'vechile_driver'){
                $field3 = "driver_name";
                $operator3 = "like";
                $value3 = "%{$search_by_text}%";
                $employee_id=Employee::select("id")->where($field3, $operator3, $value3);
                $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->whereIn('vechile_driver',$employee_id)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
            }
        }else{
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
            $data = Vechile_Information::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field4, $operator4, $value4)->orderby('id', 'ASC')->paginate(PC);
        }

        $com_code = auth()->user()->com_code;
        
        $vechile_Traffic_Violations = get_cols_where(new Vechile_Traffic_Violations(), array("*"), array("com_code" => $com_code));
      return view('admin.Maintenance.ajax_search_traffic_violations',  ['data' => $data,'vechile_Traffic_Violations'=>$vechile_Traffic_Violations]);
    }
}

 //=============================================================================================

  /////////////////////////////////////////////////////////////////////////////
  public function ajax_update_traffic_violation_payment_status(Request $request)
  {
      if ($request->ajax()) {
          try {
            $com_code = auth()->user()->com_code;
            $data_to_update['traffic_violation_payment_status']=$request->traffic_violation_payment_status;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data = get_cols_where_row(new Vechile_Traffic_Violations(), array("*"), array('com_code' => $com_code, 'id' => $request->traffic_violation_id_value));
              if (!empty($data)) {
                  echo json_encode("found");
              }
              DB::beginTransaction();
              update(new Vechile_Traffic_Violations(),$data_to_update, array("com_code" => $com_code,'id' => $request->traffic_violation_id_value));
              DB::commit();
              echo json_encode("done");  
          } catch (\Exception $ex) {
              DB::rollBack();
              echo json_encode("error");  
          }
      }    
  }
  /////////////////////////////////////////////////////////////////////////////

   // =========================================================================
 public function delete_traffic_violations($id)
 {
     try {
         $com_code = auth()->user()->com_code;
         $data = get_cols_where_row(new Vechile_Traffic_Violations(), array("id"), array('id' => $id));
         if (empty($data)) {
             return redirect()->back()->with(['error' => 'عفوا غير قادر الي الوصول البي البيانات المطلوبة !']);
         }
         DB::beginTransaction();
         destroy(new Vechile_Traffic_Violations(), array('id' => $id));
         DB::commit();
         return redirect()->back()->with(['success' => 'Data deleted successfully']);
     } catch (\Exception $ex) {
         DB::rollBack();
         return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
     }
 }
 // ====================================================================



    public function ajax_do_add_permission(Request $request){
        if ($request->ajax()) {

            $com_code = auth()->user()->com_code;
            $CheckExsists = get_cols_where_row(new Permission_sub_menues_actions(), array("id"), array("com_code" => $com_code,'name' => $request->name,'permission_sub_menues_id' => $request->permission_sub_menues_id));
            if (!empty($CheckExsists)) {
                echo json_encode("found");
              //  return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }else{
            DB::beginTransaction();
            $DataToInsert['name'] = $request->name;
            $DataToInsert['active'] = 1;
            $DataToInsert['permission_sub_menues_id'] = $request->permission_sub_menues_id;
            $DataToInsert['added_by'] = auth()->user()->id;
            $DataToInsert['com_code'] = $com_code;
            insert(new Permission_sub_menues_actions(), $DataToInsert);
            DB::commit();
            echo json_encode("done");
            }
        }
    }

    ////////////////////////////////////////////////////////////////////////
    public function ajax_load_edit_permission(Request $request){
        if ($request->ajax()) {

            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Permission_sub_menues_actions(), array("id",'name'), array("com_code" => $com_code,'id' => $request->id));
            return view('admin.Maintenance.ajax_load_edit_permission',['data'=>$data]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////////

    public function ajax_do_edit_permission(Request $request){
        if ($request->ajax()) {
            $com_code = auth()->user()->com_code;
            $data_to_update['id']=$request->id;
            $data_to_update['name']=$request->name;
            $data_to_update['updated_by'] = auth()->user()->id;
            $data = update(new Permission_sub_menues_actions(),$data_to_update, array("com_code" => $com_code,'id' => $request->id));
            return json_encode("done");
        }
    }
    /////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////

    public function ajax_do_delete_permission(Request $request)
    {
        if ($request->ajax()) {
            /*
            $com_code = auth()->user()->com_code;
             $data = get_cols_where_row(new Permission_sub_menues_actions(), array("id"), array('com_code' => $com_code,'id' => $request->id));
             if (empty($data)) {
                 echo json_encode("found");
             }else{
            DB::beginTransaction();
            destroy(new Permission_sub_menues_actions(), array('com_code' => $com_code, 'id' => $$request->id));
            DB::commit();
            echo json_encode($com_code);  
            }  
            */
            try {
                $com_code = auth()->user()->com_code;
                $data = get_cols_where_row(new Permission_sub_menues_actions(), array("*"), array('com_code' => $com_code, 'id' => $request->id));
                if (empty($data)) {
                    echo json_encode("found");  
                }
                DB::beginTransaction();
                destroy(new Permission_sub_menues_actions(), array('com_code' => $com_code, 'id' => $request->id));
                DB::commit();
                echo json_encode("done");  
            } catch (\Exception $ex) {
                DB::rollBack();
                echo json_encode("error");  
            }
        }    
    }
}
