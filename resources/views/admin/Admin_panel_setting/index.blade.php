@extends('layouts.admin')
@section('title')
الضبط العام للنظام
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admin_panel_settings.index') }}"> الضبط العام</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات الضبط العام للنظام </h3>
      </div>
      <div class="card-body">
         @if(@isset($data) and !@empty($data))
         <table id="example2" class="table table-bordered table-hover">
            <tr>
               <td class="width30">اسم الشركة</td>
               <td> {{ $data['company_name'] }}</td>
            </tr>
            <tr>
               <td class="width30"> حالة التفعيل</td>
               <td> @if($data['saysem_status']==1) مفعل@else معطل  @endif</td>
            </tr>
            <tr>
               <td class="width30">هاتف الشركة</td>
               <td> {{ $data['phones'] }}</td>
            </tr>
            <tr>
               <td class="width30">عنوان الشركة</td>
               <td> {{ $data['address'] }}</td>
            </tr>
            <tr>
               <td class="width30">بريد الشركة</td>
               <td> {{ $data['email'] }}</td>
            </tr>
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(16)==true)
            <tr>
               <td colspan="2" class="text-center">  <a href="{{ route('admin_panel_settings.edit') }}" class="btn btn-sm btn-danger">تعديل</a> </td>
            </tr>
            @endif
         </table>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection