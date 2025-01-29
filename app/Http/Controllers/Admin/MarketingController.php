<?php

namespace App\Http\Controllers\Admin;

use App\Models\Religion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReligionsRequest;
use App\Models\Driving_school_status;
use App\Models\Employee;
use App\Models\Markting;
use App\Models\Vechile_Information;
use App\Models\Vechile_Spare_Parts;
use App\Models\Vehicle_Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MarketingController extends Controller
{
    public function index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Markting(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);

        // $other['driving_school_status'] = get_cols_where(new Driving_school_status(), array("id", "name"), array("active" => 1),'id','ASC');

        return view('admin.Marketing.index', ['data' => $data]);
    }

    public function create()
    {
        return view("admin.Marketing.create");
    }

    public function store(Request $request)
    {
        $com_code = auth()->user()->com_code;
        try {
            $checkExsists = get_cols_where_row(new Markting(), array("id"), array('com_code' => $com_code, 'name' => $request->name));

            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا  هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataTonInsert['name'] = $request->name;
            $DataTonInsert['id_number'] = $request->id_number;
            $DataTonInsert['age'] = $request->age;
            $DataTonInsert['phone_number'] = $request->phone_number;
            $DataTonInsert['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
            $DataTonInsert['registeration_date'] = $request->registeration_date;
            $DataTonInsert['notes'] = $request->notes;
            $DataTonInsert['added_by'] = auth()->user()->id;
            $DataTonInsert['com_code'] = $com_code;
            insert(new Markting(), $DataTonInsert);
            DB::commit();
            return redirect()->route('Marketing.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Markting(), array("*"), array("com_code" => $com_code, "id" => $id));
        if (empty($data)) {
            return redirect()->route('Marketing.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.Marketing.edit", ['data' => $data]);
    }
    public function update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Markting(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('Marketing.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }

            $checkExsists = Markting::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['id_number'] = $request->id_number;
            $DataToUpdate['age'] = $request->age;
            $DataToUpdate['phone_number'] = $request->phone_number;
            $DataToUpdate['does_has_sudanese_Driving_License'] = $request->does_has_sudanese_Driving_License;
            $DataToUpdate['registeration_date'] = $request->registeration_date;
            $DataToUpdate['notes'] = $request->notes;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Markting(), $DataToUpdate, array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('Marketing.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
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
                return redirect()->route('Marketing.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('Marketing.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
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
                $data_to_update['driving_school_status'] = $request->driving_school_status;
                $data_to_update['updated_by'] = auth()->user()->id;
                $data = get_cols_where_row(new Employee(), array("*"), array('com_code' => $com_code, 'id' => $request->driver_id_value));
                if (!empty($data)) {
                    echo json_encode("found");
                }
                DB::beginTransaction();
                update(new Employee(), $data_to_update, array("com_code" => $com_code, 'id' => $request->driver_id_value));
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
            $registeration_date_from = $request->registeration_date_from;
            $registeration_date_to = $request->registeration_date_to;
            $age_from = $request->age_from;
            $age_to = $request->age_to;

            if ($registeration_date_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field1 = "id";
                $operator1 = ">";
                $value1 = 0;
            } else {
                $field1 = "registeration_date";
                $operator1 = ">=";
                $value1 = "$registeration_date_from";
            }
            if ($registeration_date_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field2 = "id";
                $operator2 = ">";
                $value2 = 0;
            } else {
                $field2 = "registeration_date";
                $operator2 = "<=";
                $value2 = $registeration_date_to;
            }
            if ($age_from == '') {
                //هنا نعمل شرط دائم التحقق
                $field3 = "id";
                $operator3 = ">";
                $value3 = 0;
            } else {
                $field3 = "age";
                $operator3 = ">=";
                $value3 = $age_from;
            }
            if ($age_to == '') {
                //هنا نعمل شرط دائم التحقق
                $field4 = "id";
                $operator4 = ">";
                $value4 = 0;
            } else {
                $field4 = "age";
                $operator4 = "<=";
                $value4 = $age_to;
            }
            if ($search_by_text != '') {
                if($searchbyradio == 'name'){
                    $field5 = "name";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }elseif($searchbyradio == 'id_number'){
                    $field5 = "id_number";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }else{
                    $field5 = "phone_number";
                    $operator5 = "like";
                    $value5 = "%{$search_by_text}%";
                }
            }else{
                $field5 = "id";
                $operator5 = ">";
                $value5 = 0;
            }
            $data = Markting::select("*")->where($field1, $operator1, $value1)->where($field2, $operator2, $value2)->where($field3, $operator3, $value3)->where($field4, $operator4, $value4)->where($field5, $operator5, $value5)->orderby('id', 'ASC')->paginate(PC);
            return view('admin.Marketing.ajax_search', ['data' => $data]);
        }
    }
    /////////////////////////////////////////////////////////////////////////////



}
