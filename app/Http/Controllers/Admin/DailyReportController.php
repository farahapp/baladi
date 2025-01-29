<?php

namespace App\Http\Controllers\Admin;

use App\Models\Religion;
use App\Http\Controllers\Controller;
use App\Http\Requests\dailyReportRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ReligionsRequest;
use App\Models\Admin;
use App\Models\DailyDrivingReport;
use App\Models\DailyDrivingReportDrivers;
use App\Models\DailyEmployeesReport;
use App\Models\DailyEmployeesReportTasks;
use App\Models\Driving_school_status;
use App\Models\Employee;
use App\Models\Vechile_Information;
use App\Models\Vechile_Spare_Parts;
use App\Models\Vehicle_Maintenance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DailyReportController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
       // $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
        // $Permission_main_menuesData = get_cols_where(new Permission_main_menues(), array("id", "name"), array("com_code" => $com_code, "active" => 1));
         $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
         
         $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
 
         return view('admin.DailyReport.index', ['data' => $data,'other'=>$other]);
   
  
    }

    public function show_daily_report()
    {
        $com_code = auth()->user()->com_code;
       // $mytime = Carbon::now();
      // echo $mytime->toDateTimeString();2024-03-10

        $today = Carbon::now()->format('Y-m-d');

      //  $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
      $data = get_cols_where_p(new DailyEmployeesReport(), array("*"), array("com_code" => $com_code,"date"=>$today), 'id', 'ASC', PC);
  
      $dailyEmployeesReportTasks = get_cols_where(new DailyEmployeesReportTasks(), array("*"), array("date" => $today),'id','ASC');

      $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));
 
        return view('admin.DailyReport.show_daily_report', ['data' => $data,'dailyEmployeesReportTasks'=>$dailyEmployeesReportTasks,'admins'=>$admins,'today'=>$today]);
  
    }

    public function show_daily_driving_report()
    {
        $com_code = auth()->user()->com_code;
        $today = Carbon::now()->format('Y-m-d');

        $data = get_cols_where_p(new DailyDrivingReport(), array("*"), array("com_code" => $com_code,"date"=>$today), 'id', 'ASC', PC);

        $dailyDrivingReportDrivers = get_cols_where(new DailyDrivingReportDrivers(), array("*"), array("date" => $today),'id','ASC');

        $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));

       
     
        return view('admin.DailyReport.show_daily_driving_report', ['data' => $data,'dailyDrivingReportDrivers'=>$dailyDrivingReportDrivers,'admins'=>$admins,'today'=>$today]);
  
    }




    public function index_driving_report()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Employee(), array("*"), array("com_code" => $com_code), "id", "DESC", PC);
         
        $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.DailyReport.index_driving_report', ['data' => $data,'other'=>$other]);
  
    }

    public function create()
    {
        return view("admin.DailyReport.create");
    }

    public function store(Request $request)
    {

        $request->validate([
            'inputs.*.name'=>'required',
        ],
        [
            'inputs.*.name'=>'الاسم مطلوب',
        ]
        
        );
                 $com_code = auth()->user()->com_code;
                 $DataToInsert['note'] = $request->note;
                 $DataToInsert['date'] = date("Y-m-d");
                 $DataToInsert['complete_tasks_no'] = 1;
                 $DataToInsert['non_complete_tasks_no'] =  var_dump(count($request->inputs, COUNT_RECURSIVE));
                 $DataToInsert['added_by'] = auth()->user()->id;
                 $DataToInsert['com_code'] = $com_code;
                 $note= insert(new DailyEmployeesReport(), $DataToInsert);
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
            DailyEmployeesReportTasks::create($value);
        }
        return back()->with('success','تم إرسال التقرير');
    }


    public function store_driving_report(Request $request)
    {

       
                 $com_code = auth()->user()->com_code;
                 $DataToInsert['note'] = $request->note;
                 $DataToInsert['date'] = date("Y-m-d");
                 $DataToInsert['drivers_number'] = 1;
                 $DataToInsert['added_by'] = auth()->user()->id;
                 $DataToInsert['com_code'] = $com_code;
                 $note= insert(new DailyDrivingReport(), $DataToInsert);
            if (!$note) {
                return redirect()->back()->with(['error' => 'عفوا حدث خطاء ما '])->withInput();
            }
           // array_push($request->inputs, $note->id);
           //echo($request->inputs[0].value('name'));
        foreach ($request->inputs as $key => $value) {
            $value['daily_driving_report_id']=$note->id;
            $value['date']=date("Y-m-d");
            $value['com_code']=auth()->user()->com_code;
            $value['added_by']=auth()->user()->id;
            //$request->inputs['key']['daily_employees_report_id']=$note->id;
            DailyDrivingReportDrivers::create($value);
        }
        return back()->with('success','تم إرسال التقرير');
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
        if (empty($data)) {
            return redirect()->route('DailyReport.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.DailyReport.edit", ['data' => $data]);
    }
    public function update($id, ReligionsRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('DailyReport.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }

            $checkExsists = Religion::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Religion(), $DataToUpdate, array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('DailyReport.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
                return redirect()->route('DailyReport.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('DailyReport.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
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

public function ajax_update_driving_report_status(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['report_status']=$request->report_status;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new DailyDrivingReport(), array("*"), array('com_code' => $com_code, 'id' => $request->report_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new DailyDrivingReport(),$data_to_update, array("com_code" => $com_code,'id' => $request->report_id_value));
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

public function ajax_update_report_status(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['report_status']=$request->report_status;
          $data_to_update['updated_by'] = auth()->user()->id;
          $data = get_cols_where_row(new DailyEmployeesReport(), array("*"), array('com_code' => $com_code, 'id' => $request->report_id_value));
            if (!empty($data)) {
                echo json_encode("found");
            }
            DB::beginTransaction();
            update(new DailyEmployeesReport(),$data_to_update, array("com_code" => $com_code,'id' => $request->report_id_value));
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
            if ($driving_school_status_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "driving_school_status";
                $operator2 = "=";
                $value2 = $driving_school_status_search;
            }
            $data = Employee::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->orderby('id', 'DESC')->paginate(PC);
            $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');
            return view('admin.DailyReport.ajax_search', ['data' => $data,'other'=>$other]);
            }
    }
    /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
public function ajax_daily_report_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $report_date_search = $request->report_date_search;
            $report_status_search = $request->report_status_search;
            
            if ($search_by_text == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "added_by";
                $operator1 = "=";
                $value1 = "$search_by_text";
            }
            if ($report_date_search == '') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "date";
                $operator2 = "LIKE";
                $value2 = "%{$report_date_search}%";
            }
            if ($report_status_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "report_status";
                $operator3 = "=";
                $value3 = $report_status_search;
            }
            $data = DailyEmployeesReport::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'DESC')->paginate(PC);
            $dailyEmployeesReportTasks = get_cols_where(new DailyEmployeesReportTasks(), array("*"), array("com_code" => 1));
            $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));

         

            return view('admin.DailyReport.ajax_daily_report_search', ['data' => $data,'dailyEmployeesReportTasks'=>$dailyEmployeesReportTasks,'admins'=>$admins,'today'=>$report_date_search]);
            }
    }
    /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
public function ajax_daily_driving_report_search(Request $request)
    {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $report_date_search = $request->report_date_search;
            $report_status_search = $request->report_status_search;
            
            if ($search_by_text == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "added_by";
                $operator1 = "=";
                $value1 = "$search_by_text";
            }
            if ($report_date_search == '') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "date";
                $operator2 = "LIKE";
                $value2 = "%{$report_date_search}%";
            }
            if ($report_status_search == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "report_status";
                $operator3 = "=";
                $value3 = $report_status_search;
            }
            $data = DailyDrivingReport::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'DESC')->paginate(PC);
                 $dailyDrivingReportDrivers = get_cols_where(new DailyDrivingReportDrivers(), array("*"), array("com_code" => 1));
         $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));


            return view('admin.DailyReport.ajax_daily_driving_report_search', ['data' => $data,'dailyDrivingReportDrivers'=>$dailyDrivingReportDrivers,'admins'=>$admins,'today'=>$report_date_search]);
            }
    }
    /////////////////////////////////////////////////////////////////////////////





}
