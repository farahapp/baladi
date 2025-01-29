@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Employees.index') }}">     الموظفين</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات  الموظفين 
            <a href="{{ route('Employees.create') }}" class="btn btn-sm btn-success">اضافة جديد</a>
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>    اسم السائق</th>
               <th>   جواز السفر </th>
               <th> توقيع العقد المبدئي </th>
               <th>  حالة التاشيرة </th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->driver_name }}</td>
                  <td>{{ $info->driver_pasport_no }}</td>
            
               
                     <td 
                     @if ($info->isSigningInitialContract==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isSigningInitialContract==1) موقع @else غير موقع 
                     @endif
                     </td>

                     <td 
                     @if ($info->isVisaPrinted==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isVisaPrinted==1) مطبوعة @else غير مطبوعة 
                     @endif
                     </td>
               
                  <td>
                     <a  href="{{ route('Religions.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تعديل</a>
                     <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <br>
         <div class="col-md-12 text-center">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
