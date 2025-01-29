<?php

namespace App\Http\Controllers\Admin;

use App\Models\Religion;
use App\Http\Controllers\Controller;
use App\Http\Requests\ComplaintsRequest;
use Illuminate\Http\Request;
use App\Http\Requests\ReligionsRequest;
use App\Imports\AttendenceImport;
use App\Models\Admin;
use App\Models\Admin_panel_setting;
use App\Models\Attendence;
use App\Models\Complaints;
use App\Models\DailyEmployeesReport;
use App\Models\DailyEmployeesReportTasks;
use App\Models\Employee;
use App\Models\Shifts_type;
use App\Models\Subject;
use App\Models\Vechile_Information;
use App\Models\Vechile_Spare_Parts;
use App\Models\Vehicle_Maintenance;
use App\Models\Week;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class QualityController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
       $ateendance_device_no = get_cols_where(new Employee(),array("ateendance_device_no"),array('com_code' => $com_code),'id', 'DESC');
       $data = Attendence::select("*")->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
          return view('admin.Quality.index', ['data' => $data]);
    }

    public function administrativeIndex()
    {
        $com_code = auth()->user()->com_code;
       $ateendance_device_no = get_cols_where(new Admin(),array("ateendance_device_no"),array('com_code' => $com_code),'id', 'DESC');
       $data = Attendence::select("*")->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
          return view('admin.Quality.administrativeIndex', ['data' => $data]);
    }


    public function create()
    {
        return view("admin.Quality.create");
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
            return redirect()->route('Quality.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
        if (empty($data)) {
            return redirect()->route('Quality.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.Quality.edit", ['data' => $data]);
    }
    public function update($id, ReligionsRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('Quality.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
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
            return redirect()->route('Quality.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
                return redirect()->route('Quality.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('Quality.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function importAttendenceIndex()
    {
        return view("admin.Quality.importAttendence");

    }

    public function importAttendenceStore(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);


        //Excel::import(new AttendenceImport, $request->file('import_file'));
        
        try {
            Excel::import(new AttendenceImport($request->file('import_file')->extension()),$request->file('import_file'));
            }catch (\Error $ex) {
                        throw new \Exception('Error:' . $ex->getMessage());
                    }

     //   (new AttendenceImport)->import($request->file('import_file'));


       // Excel::toArray(new AttendenceImport, $request->file('import_file'));

        return redirect()->back()->with(['success' => 'تم تحديث الحضور بنجاح']);



    }


    public function MyCalendarIndex()
    {
        
        $com_code = auth()->user()->com_code;

        $result =array();

     //$MySubject= get_cols_where_p(new Subject(), array("id"), 'id', 'ASC');

     $MySubject= Subject::select('*')->orderby('id','ASC')->get();

     
     foreach($MySubject as $subject){
        $dataS['name']=$subject->name;

       // $daysOfWeek=get_cols_where_p(new Week(), array("*"), 'id', 'ASC');

        $daysOfWeek= Week::select('*')->orderby('id','ASC')->get();

       // $daysOfWeek=['0','1','2','3','4','5'];

       $week=array();

        foreach($daysOfWeek as $weak_day){
            $dataW=array();
            $dataW['week_id']=$weak_day->id;
            $dataW['week_name']=$weak_day->name;
            $dataW['fullcalendar_day']=$weak_day->fullcalendar_day;
            $ClassSubject=Shifts_type::where('subject','=',$subject->id)->where('weak_day','=',$weak_day->id)->first();
            if(!empty($ClassSubject)){
                $dataW['start_time']=$ClassSubject->from_time;
                $dataW['end_time']=$ClassSubject->to_time;
                $week[]=$dataW;
            }
            // $data = get_cols_where_p(new Shifts_type(), array("*"), array("com_code" => $com_code), 'id', 'DESC');
            // $weak_days= get_cols_where_p(new Shifts_type(), array("weak_day"), array("com_code" => $com_code), 'id', 'DESC');
        }
        $dataS['week']=$week;
        $result[]=$dataS;

    }

       // $data2 = get_cols_where_row(new Shifts_type(), array("*"), array('com_code' => $com_code), 'id', 'DESC');

       // dd($result);
        return view('admin.Quality.my_calendar', ['data' => $result]);
    }
    
     /////////////////////////////////////////////////////////////////////////////

     public function administrativeComplaints()
    {
        $com_code = auth()->user()->com_code;
      
       

      $data = get_cols_where_p(new Complaints(), array("*"), array("com_code" => $com_code), 'id', 'Desc', PC);
  

      $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));
 
        return view('admin.Quality.administrative_complaints', ['data' => $data,'admins'=>$admins]);
  
    }

/////////////////////////////////////////////////////////////////////////////
    public function administrativeSendComplaintsCreate()
    {
        return view("admin.Quality.sendComplaintsCreate");
    }

/////////////////////////////////////////////////////////////////////////////

    public function administrativeSendComplaintsStore(ComplaintsRequest $request)
    {
        $com_code = auth()->user()->com_code;
        try {
            DB::beginTransaction();
            $DataTonInsert['complaint_title'] = $request->complaint_title;
            $DataTonInsert['complaint'] = $request->complaint;
            $DataTonInsert['complaint_status'] = 0;
            $DataTonInsert['added_by'] = auth()->user()->id;
            $DataTonInsert['com_code'] = $com_code;
            insert(new Complaints(), $DataTonInsert);
            DB::commit();
            return redirect()->back()->with(['success' => 'تم إرسال الشكوى بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    
     /////////////////////////////////////////////////////////////////////////////
public function driver_ajax_search2(Request $request)
{
    if ($request->ajax()) {
        $search_by_text = $request->search_by_text;
        $AttendanceStatus = $request->AttendanceStatus;
        $attendance_date_from = $request->attendance_date_from;
        $attendance_date_to = $request->attendance_date_to;
        $attendance_time_from = $request->attendance_time_from;
        $attendance_time_to = $request->attendance_time_to;
        
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
        if ($AttendanceStatus == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "AttendanceStatus";
            $operator2 = "LIKE";
            $value2 = $AttendanceStatus;
        }
        if ($attendance_date_from == '') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "Date";
            $operator3 = ">=";
            $value3 = $attendance_date_from;
        }
        if ($attendance_date_to == '') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "Date";
            $operator4 = "<=";
            $value4 = $attendance_date_to;
        }        
        
      
       //$ateendance_device_no = Employee::select("ateendance_device_no")->where($field1, $operator1, $value1)->where('com_code','=', $com_code)->orderby('id', 'ASC');
      // $data = Attendence::select("*")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
       
       $com_code = auth()->user()->com_code;

       $ateendance_device_no = get_cols_where(new Employee(),array("ateendance_device_no"),array('com_code' => $com_code),'id', 'DESC');
       $data = Attendence::select("*")->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
   
          
       // return view('Quality.driver_ajax_search', ['data' => $data]);


  
 }
}

/////////////////////////////////////////////////////////////////////////////

    
     /////////////////////////////////////////////////////////////////////////////
     public function driver_ajax_search(Request $request)
     {
         if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $AttendanceStatus = $request->AttendanceStatus;
            $attendance_date_from = $request->attendance_date_from;
            $attendance_date_to = $request->attendance_date_to;
            $attendance_time_from = $request->attendance_time_from;
            $attendance_time_to = $request->attendance_time_to;
            $date_filter = $request->date_filter;



             
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
            if ($AttendanceStatus == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "AttendanceStatus";
                $operator2 = "LIKE";
                $value2 = $AttendanceStatus;
            }
            if ($attendance_date_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "Date";
                $operator3 = ">=";
                $value3 = $attendance_date_from;
            }
            if ($attendance_date_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field4 = "id";
                $operator4 = ">";
                $value4 = 0;
            } else {
                $field4 = "Date";
                $operator4 = "<=";
                $value4 = $attendance_date_to;
            }
            if ($attendance_time_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field5 = "id";
                $operator5 = ">";
                $value5 = 0;
            } else {
                $field5 = "Time";
                $operator5 = ">=";
                $value5 = $attendance_time_from;
            }
            if ($attendance_time_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field6 = "id";
                $operator6 = ">";
                $value6 = 0;
            } else {
                $field6 = "Time";
                $operator6 = "<=";
                $value6 = $attendance_time_to;
            }
            if ($date_filter == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field7 = "id";
                $operator7 = ">";
                $value7 = 0;
            } elseif($date_filter == 'today') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::today();
            }elseif($date_filter == 'yesterday') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::yesterday();
            }elseif($date_filter == 'this_week') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfWeek();
            }elseif($date_filter == 'last_week') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = new Carbon('first day of last week');
            }elseif($date_filter == 'this_month') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfMonth();
            }elseif($date_filter == 'last_month') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = new Carbon('first day of last month');
            }elseif($date_filter == 'this_year') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfYear();
            }elseif($date_filter == 'last_year') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->subYear()->startOfYear();
            }

             $ateendance_device_no = Employee::select("ateendance_device_no")->where($field1, $operator1, $value1)->where('com_code','=', '1');
             $data = Attendence::select("*")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->whereTime($field5, $operator5,\Carbon\Carbon::parse($value5))->whereTime($field6, $operator6, \Carbon\Carbon::parse($value6))->where($field7, $operator7, $value7)->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
      

             return view('admin.Quality.driver_ajax_search',['data' => $data]);
       
             }
     }
     /////////////////////////////////////////////////////////////////////////////
     public function Administrative_ajax_search(Request $request)
     {
        if ($request->ajax()) {
            $search_by_text = $request->search_by_text;
            $AttendanceStatus = $request->AttendanceStatus;
            $attendance_date_from = $request->attendance_date_from;
            $attendance_date_to = $request->attendance_date_to;
            $attendance_time_from = $request->attendance_time_from;
            $attendance_time_to = $request->attendance_time_to;
            $date_filter = $request->date_filter;

             
            if ($search_by_text == '') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "name";
                $operator1 = "LIKE";
                $value1 = "%{$search_by_text}%";
            }
            if ($AttendanceStatus == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "AttendanceStatus";
                $operator2 = "LIKE";
                $value2 = $AttendanceStatus;
            }
            if ($attendance_date_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "Date";
                $operator3 = ">=";
                $value3 = $attendance_date_from;
            }
            if ($attendance_date_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field4 = "id";
                $operator4 = ">";
                $value4 = 0;
            } else {
                $field4 = "Date";
                $operator4 = "<=";
                $value4 = $attendance_date_to;
            }
            if ($attendance_time_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field5 = "id";
                $operator5 = ">";
                $value5 = 0;
            } else {
                $field5 = "Time";
                $operator5 = ">=";
                $value5 = $attendance_time_from;
            }
            if ($attendance_time_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field6 = "id";
                $operator6 = ">";
                $value6 = 0;
            } else {
                $field6 = "Time";
                $operator6 = "<=";
                $value6 = $attendance_time_to;
            }
            if ($date_filter == 'all') {
                //هنا نعمل شرط دائم التحقق
                $field7 = "id";
                $operator7 = ">";
                $value7 = 0;
            } elseif($date_filter == 'today') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::today();
                $dateFilterQuery="wheredate('Date',Carbon::today())";
            }elseif($date_filter == 'yesterday') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::yesterday();
            }elseif($date_filter == 'this_week') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfWeek();
            }elseif($date_filter == 'last_week') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = new Carbon('first day of last week');
            }elseif($date_filter == 'this_month') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfMonth();
            }elseif($date_filter == 'last_month') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = new Carbon('first day of last month');
            }elseif($date_filter == 'this_year') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = Carbon::now()->startOfYear();
            }elseif($date_filter == 'last_year') {
                $field7 = "Date";
                $operator7 = ">=";
                $value7 = new Carbon('first day of last year');
            }


             $ateendance_device_no = Admin::select("ateendance_device_no")->where($field1, $operator1, $value1)->where('com_code','=', '1');
             $data = Attendence::select("*")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->whereTime($field5, $operator5,\Carbon\Carbon::parse($value5))->whereTime($field6, $operator6, \Carbon\Carbon::parse($value6))->where($field7, $operator7, $value7)->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
      

             return view('admin.Quality.Administrative_ajax_search',['data' => $data]);
       
             }
     }
     /////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

public function ajax_update_complaint_status(Request $request)
{
    if ($request->ajax()) {
        try {
          $com_code = auth()->user()->com_code;
          $data_to_update['complaint_status']=$request->complaint_status;
          $data_to_update['updated_by'] = auth()->user()->id;
            DB::beginTransaction();
            update(new Complaints(),$data_to_update, array("com_code" => $com_code,'id' => $request->complaint_id_value));
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
public function complaints_ajax_search(Request $request)
{
    if ($request->ajax()) {
        $search_by_text = $request->search_by_text;
        $complaint_date_search = $request->complaint_date_search;
        $complaint_status_search = $request->complaint_status_search;
        
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
        if ($complaint_date_search == '') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "date";
            $operator2 = "LIKE";
            $value2 = "%{$complaint_date_search}%";
        }
        if ($complaint_status_search == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "complaint_status";
            $operator3 = "=";
            $value3 = $complaint_status_search;
        }
        $data = Complaints::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->orderby('id', 'DESC')->paginate(PC);
        $admins = get_cols_where(new Admin(), array("*"), array("com_code" => 1));

           return view('admin.Quality.administrative_complaints_ajax_search', ['data' => $data,'admins'=>$admins]);

        }
}
/////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////
  public function print_driver_search(Request $request)
  {
         $search_by_text = $request->search_by_text;
         $AttendanceStatus = $request->AttendanceStatus;
         $attendance_date_from = $request->attendance_date_from;
         $attendance_date_to = $request->attendance_date_to;
         $attendance_time_from = $request->attendance_time_from;
         $attendance_time_to = $request->attendance_time_to;
         $date_filter = $request->date_filter;



          
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
         if ($AttendanceStatus == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field2 = "id";
             $operator2 = ">";
             $value2 = 0;
         } else {
             $field2 = "AttendanceStatus";
             $operator2 = "LIKE";
             $value2 = $AttendanceStatus;
         }
         if ($attendance_date_from == '') {
             //هنا نعمل شرط دائم التحقق
             $field3 = "id";
             $operator3 = ">";
             $value3 = 0;
         } else {
             $field3 = "Date";
             $operator3 = ">=";
             $value3 = $attendance_date_from;
         }
         if ($attendance_date_to == '') {
             //هنا نعمل شرط دائم التحقق
             $field4 = "id";
             $operator4 = ">";
             $value4 = 0;
         } else {
             $field4 = "Date";
             $operator4 = "<=";
             $value4 = $attendance_date_to;
         }
         if ($attendance_time_from == '') {
             //هنا نعمل شرط دائم التحقق
             $field5 = "id";
             $operator5 = ">";
             $value5 = 0;
         } else {
             $field5 = "Time";
             $operator5 = ">=";
             $value5 = $attendance_time_from;
         }
         if ($attendance_time_to == '') {
             //هنا نعمل شرط دائم التحقق
             $field6 = "id";
             $operator6 = ">";
             $value6 = 0;
         } else {
             $field6 = "Time";
             $operator6 = "<=";
             $value6 = $attendance_time_to;
         }
         if ($date_filter == 'all') {
             //هنا نعمل شرط دائم التحقق
             $field7 = "id";
             $operator7 = ">";
             $value7 = 0;
         } elseif($date_filter == 'today') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::today();
         }elseif($date_filter == 'yesterday') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::yesterday();
         }elseif($date_filter == 'this_week') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::now()->startOfWeek();
         }elseif($date_filter == 'last_week') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = new Carbon('first day of last week');
         }elseif($date_filter == 'this_month') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::now()->startOfMonth();
         }elseif($date_filter == 'last_month') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = new Carbon('first day of last month');
         }elseif($date_filter == 'this_year') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::now()->startOfYear();
         }elseif($date_filter == 'last_year') {
             $field7 = "Date";
             $operator7 = ">=";
             $value7 = Carbon::now()->subYear()->startOfYear();
         }

          $com_code = auth()->user()->com_code;

          $ateendance_device_no = Employee::select("ateendance_device_no")->where($field1, $operator1, $value1)->where('com_code','=', '1');
          $data = Attendence::select("*")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->whereTime($field5, $operator5,\Carbon\Carbon::parse($value5))->whereTime($field6, $operator6, \Carbon\Carbon::parse($value6))->where($field7, $operator7, $value7)->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->get();
          
          $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));

          return view('admin.Quality.print_driver_search',['data' => $data,'systemData'=>$systemData]);
  }
  /////////////////////////////////////////////////////////////////////////////
 /////////////////////////////////////////////////////////////////////////////
 public function print_administrative_search(Request $request)
 {
        $search_by_text = $request->search_by_text;
        $AttendanceStatus = $request->AttendanceStatus;
        $attendance_date_from = $request->attendance_date_from;
        $attendance_date_to = $request->attendance_date_to;
        $attendance_time_from = $request->attendance_time_from;
        $attendance_time_to = $request->attendance_time_to;
        $date_filter = $request->date_filter;

         
        if ($search_by_text == '') {
            //هنا نعمل شرط دائم التحقق
            $field1 = "id";
            $operator1 = ">";
            $value1 = 0;
        } else {
            $field1 = "name";
            $operator1 = "LIKE";
            $value1 = "%{$search_by_text}%";
        }
        if ($AttendanceStatus == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field2 = "id";
            $operator2 = ">";
            $value2 = 0;
        } else {
            $field2 = "AttendanceStatus";
            $operator2 = "LIKE";
            $value2 = $AttendanceStatus;
        }
        if ($attendance_date_from == '') {
            //هنا نعمل شرط دائم التحقق
            $field3 = "id";
            $operator3 = ">";
            $value3 = 0;
        } else {
            $field3 = "Date";
            $operator3 = ">=";
            $value3 = $attendance_date_from;
        }
        if ($attendance_date_to == '') {
            //هنا نعمل شرط دائم التحقق
            $field4 = "id";
            $operator4 = ">";
            $value4 = 0;
        } else {
            $field4 = "Date";
            $operator4 = "<=";
            $value4 = $attendance_date_to;
        }
        if ($attendance_time_from == '') {
            //هنا نعمل شرط دائم التحقق
            $field5 = "id";
            $operator5 = ">";
            $value5 = 0;
        } else {
            $field5 = "Time";
            $operator5 = ">=";
            $value5 = $attendance_time_from;
        }
        if ($attendance_time_to == '') {
            //هنا نعمل شرط دائم التحقق
            $field6 = "id";
            $operator6 = ">";
            $value6 = 0;
        } else {
            $field6 = "Time";
            $operator6 = "<=";
            $value6 = $attendance_time_to;
        }
        if ($date_filter == 'all') {
            //هنا نعمل شرط دائم التحقق
            $field7 = "id";
            $operator7 = ">";
            $value7 = 0;
        } elseif($date_filter == 'today') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = Carbon::today();
            $dateFilterQuery="wheredate('Date',Carbon::today())";
        }elseif($date_filter == 'yesterday') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = Carbon::yesterday();
        }elseif($date_filter == 'this_week') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = Carbon::now()->startOfWeek();
        }elseif($date_filter == 'last_week') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = new Carbon('first day of last week');
        }elseif($date_filter == 'this_month') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = Carbon::now()->startOfMonth();
        }elseif($date_filter == 'last_month') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = new Carbon('first day of last month');
        }elseif($date_filter == 'this_year') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = Carbon::now()->startOfYear();
        }elseif($date_filter == 'last_year') {
            $field7 = "Date";
            $operator7 = ">=";
            $value7 = new Carbon('first day of last year');
        }


        $com_code = auth()->user()->com_code;


         $ateendance_device_no = Admin::select("ateendance_device_no")->where($field1, $operator1, $value1)->where('com_code','=', '1');
         $data = Attendence::select("*")->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->whereTime($field5, $operator5,\Carbon\Carbon::parse($value5))->whereTime($field6, $operator6, \Carbon\Carbon::parse($value6))->where($field7, $operator7, $value7)->where('AttendanceStatus','!=','undefined')->whereIn('sJobNo',$ateendance_device_no)->orderBy( 'id', 'DESC')->paginate(20);
  
         $systemData=get_cols_where_row(new Admin_panel_setting(),array('company_name','image','phones','address'),array("com_code"=>$com_code));

         return view('admin.Quality.print_administrative_search',['data' => $data,'systemData'=>$systemData]);
   
        
 }
 /////////////////////////////////////////////////////////////////////////////
      

    
}
