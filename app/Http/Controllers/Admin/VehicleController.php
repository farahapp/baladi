<?php

namespace App\Http\Controllers\Admin;

use App\Models\Religion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReligionsRequest;
use App\Models\Vechile_Model;
use App\Models\Vechile_Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VehicleController extends Controller
{
    public function vehicle_type_index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Vechile_Type(), array("*"), array('com_code' => $com_code), 'id', 'ASC', PC);
        return view('admin.VehicleType.index', ['data' => $data]);
    }
    public function vehicle_type_create()
    {
        return view("admin.VehicleType.create");
    }

    public function vehicle_type_store(Request $request)
    {
        $com_code = auth()->user()->com_code;
        try {
            $checkExsists = get_cols_where_row(new Vechile_Type(), array("id"), array('com_code' => $com_code, 'name' => $request->name));

            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا  هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataTonInsert['name'] = $request->name;
            $DataTonInsert['active'] = $request->active;
            $DataTonInsert['added_by'] = auth()->user()->id;
            $DataTonInsert['com_code'] = $com_code;
            insert(new Vechile_Type(), $DataTonInsert);
            DB::commit();
            return redirect()->route('VehicleType.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function vehicle_type_edit($id)
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_row(new Vechile_Type(), array("*"), array("com_code" => $com_code, "id" => $id));
        if (empty($data)) {
            return redirect()->route('VehicleType.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.VehicleType.edit", ['data' => $data]);
    }
    public function vehicle_type_update($id, ReligionsRequest $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Type(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('VehicleType.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }

            $checkExsists = Vechile_Type::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Vechile_Type(), $DataToUpdate, array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('VehicleType.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function vehicle_type_destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('VehicleType.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('VehicleType.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function vehicle_model_index()
    {
        $com_code = auth()->user()->com_code;
        $data = get_cols_where_p(new Vechile_Model(), array("*"), array('com_code' => $com_code), 'id', 'DESC', PC);
        return view('admin.VehicleModel.index', ['data' => $data]);
    }
    public function vehicle_model_create()
    {
        $com_code = auth()->user()->com_code;
        $data['Vechile_Type'] = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);
        return view("admin.VehicleModel.create", ['data' => $data]);
    }

    public function vehicle_model_store(Request $request)
    {
        $com_code = auth()->user()->com_code;
        try {
            $checkExsists = get_cols_where_row(new Vechile_Model(), array("id"), array('com_code' => $com_code, 'name' => $request->name));

            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا  هذا الاسم مسجل من قبل '])->withInput();
            }
            DB::beginTransaction();
            $DataTonInsert['name'] = $request->name;
            $DataTonInsert['vechile_type'] = $request->vechile_type;
            $DataTonInsert['vechile_car_or_bike'] = 1;
            $DataTonInsert['active'] = $request->active;
            $DataTonInsert['added_by'] = auth()->user()->id;
            $DataTonInsert['com_code'] = $com_code;
            insert(new Vechile_Model(), $DataTonInsert);
            DB::commit();
            return redirect()->route('VehicleModel.index')->with(['success' => 'تم ادخال البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
    public function vehicle_model_edit($id)
    {
        $com_code = auth()->user()->com_code;
        $Vechile_Model = get_cols_where_row(new Vechile_Model(), array("*"), array("com_code" => $com_code, "id" => $id));
        $Vechile_Type = get_cols_where_p(new Vechile_Type(), array("*"), array("com_code" => $com_code), "id", "ASC", PC);

        if (empty($Vechile_Model)) {
            return redirect()->route('VehicleModel.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
        }
        return view("admin.VehicleModel.edit", ['Vechile_Model' => $Vechile_Model,'Vechile_Type'=>$Vechile_Type]);
    }
    public function vehicle_model_update($id, Request $request)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Vechile_Model(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('VehicleModel.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }

            $checkExsists = Religion::select("id")->where("com_code", "=", $com_code)->where("name", "=", $request->name)->where("id", "!=", $id)->first();
            if (!empty($checkExsists)) {
                return redirect()->back()->with(['error' => 'عفوا هذا الاسم مسجل من قبل'])->withInput();
            }
            DB::beginTransaction();
            $DataToUpdate['name'] = $request->name;
            $DataToUpdate['vechile_type'] = $request->vechile_type;
            $DataToUpdate['active'] = $request->active;
            $DataToUpdate['updated_by'] = auth()->user()->id;
            update(new Vechile_Model(), $DataToUpdate, array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('VehicleModel.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }

    public function vehicle_model_destroy($id)
    {
        try {
            $com_code = auth()->user()->com_code;
            $data = get_cols_where_row(new Religion(), array("*"), array("com_code" => $com_code, "id" => $id));
            if (empty($data)) {
                return redirect()->route('VehicleModel.index')->with(['error' => 'عفوا غير قادر للوصول الي البيانات المطلوبة !']);
            }
            DB::beginTransaction();
            destroy(new Religion(), array("com_code" => $com_code, "id" => $id));
            DB::commit();
            return redirect()->route('VehicleModel.index')->with(['success' => 'تم الحذف البيانات بنجاح']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'عفوا حدث خطأ ' . $ex->getMessage()])->withInput();
        }
    }
}
