<?php

namespace App\Http\Controllers\Admin;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Jobs_categoriesRequest;
use Illuminate\Support\Facades\DB;

class SubjectsController extends Controller
{
  public function index()
  {
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_p(new Subject(), array("*"), array('com_code' => $com_code), 'id', 'DESC', PC);
    return view('admin.Subjects.index', ['data' => $data]);
  }

  public function create()
  {
    return view('admin.Subjects.create');
  }

  public function store(Jobs_categoriesRequest $request)
  {
    try {
      $com_code = auth()->user()->com_code;
      $CheckExsists = get_cols_where_row(new Subject(), array("id"), array("name" => $request->name, 'com_code' => $com_code));
      if (!empty($CheckExsists)) {
        return redirect()->back()->with(['error' => 'عفوا  اسم الوظيفة مسجل من قبل ! '])->withInput();
      }
      DB::beginTransaction();
      $dataToInsert['name'] = $request->name;
      $dataToInsert['active'] = $request->active;
      $dataToInsert['added_by'] = auth()->user()->id;
      $dataToInsert['com_code'] = $com_code;
      insert(new Subject(), $dataToInsert);
      DB::commit();
      return redirect()->route('subjects.index')->with(['success' => 'تم اضافة البيانات بنجاح']);
    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->back()->with(['error' => 'عفوا حدث خطأ ما ' . $ex->getMessage()])->withInput();
    }
  }

  public function edit($id)
  {
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new Subject(), array("*"), array("com_code" => $com_code, 'id' => $id));
    if (empty($data)) {
      return redirect()->route('subjects.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
    }
    return view('admin.Subjects.edit', ['data' => $data]);
  }

  public function update($id, Jobs_categoriesRequest $request)
  {
    $com_code = auth()->user()->com_code;
    try {
      $CheckExsists = Subject::select("id")->where("com_code", "=", $com_code)->where('name', '=', $request->name)->where('id', '!=', $id)->first();
      if (!empty($CheckExsists)) {
        return redirect()->back()->with(['error' => 'عفوا  اسم الوظيفة مسجل من قبل ! '])->withInput();
      }
      DB::beginTransaction();
      $dataToUpdate['name'] = $request->name;
      $dataToUpdate['active'] = $request->active;
      $dataToUpdate['updated_by'] = auth()->user()->id;
      update(new Subject(), $dataToUpdate, array("com_code" => $com_code, 'id' => $id));
      DB::commit();
      return redirect()->route('subjects.index')->with(['success' => 'تم تحديث البيانات بنجاح']);
    } catch (\Exception $ex) {
      DB::rollBack();
      return redirect()->back()->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()])->withInput();
    }
    $com_code = auth()->user()->com_code;
    $data = get_cols_where_row(new Subject(), array("*"), array("com_code" => $com_code, 'id' => $id));
    if (empty($data)) {
      return redirect()->route('subjects.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
    }

  }

  public function destroy($id)
  {
    try{
      $com_code = auth()->user()->com_code;
      $data = get_cols_where_row(new Subject(), array("*"), array("com_code" => $com_code, 'id' => $id));
      if (empty($data)) {
        return redirect()->route('subjects.index')->with(['error' => 'عفوا غير قادر الي الوصول الي البيانات المطلوبة']);
      }
      DB::beginTransaction();
      destroy(new Subject(),array("com_code" => $com_code, 'id' => $id));
      DB::commit();
  return redirect()->route('subjects.index')->with(['success'=>'تم الحذف بنجاح']);
    }catch(\Exception $ex){
      DB::rollBack();
      return redirect()->route('subjects.index')->with(['error' => 'عفوا حدث خطا ' . $ex->getMessage()]);
    }
 

  }


}
