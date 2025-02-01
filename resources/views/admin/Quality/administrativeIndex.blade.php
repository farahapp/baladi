@extends('layouts.admin')
@section('title')
الجودة 
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
حضور الموظفين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   حضور الموظفين   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات   حضور الموظفين 
            {{-- <a href="{{ route('Maintenance.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a> --}}
         </h3>
      </div>


      <form method="POST" action="{{ route('Quality.print_administrative_search') }}" target="_blank">
         @csrf

         <input type="hidden" id="token_search" value="{{csrf_token()}}">
         <input type="hidden" id="ajax_search_url" value="{{route('Quality.Administrative_ajax_search')}}">



      <div class="row" style="padding: 5px;">

         <div class="col-md-3">
            <div class="form-group">
               <label>  بحث بالموظف </label>
               <input type="text"  autofocus name="search_by_text" id="search_by_text" class="form-control" value="" placeholder="بحث بالاسم">
            </div>
         </div>

         <div class="col-md-3">
            <div class="form-group">
               <label> دخول أو إنصراف </label>
               <select  name="AttendanceStatus" id="AttendanceStatus" class="form-control">
                  <option   value="all">الكل</option>
                  <option   value="checkIn">دخول</option>
                  <option   value="checkOut">خروج</option>
               </select>
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث من تاريخ </label>
               <input type="date" class="form-control" name="attendance_date_from" id="attendance_date_from" value="">
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث الى تاريخ </label>
               <input type="date" class="form-control" name="attendance_date_to" id="attendance_date_to" value="">
            </div>
         </div>



         <div class="col-md-3">
            <div class="form-group">
               <label>بحث من وقت </label>
               <input type="time" class="form-control" name="attendance_time_from" id="attendance_time_from" value="">
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث الى وقت </label>
               <input type="time" class="form-control" name="attendance_time_to" id="attendance_time_to" value="">
            </div>
         </div>

         <div class="col-md-3">
            <div class="form-group">
               <label> نوع التقرير </label>
               <select  name="date_filter" id="date_filter" class="form-control">
                  <option   value="all">الكل</option>
                  <option   value="today">اليوم</option>
                  <option   value="yesterday">فترة الأمس واليوم</option>
                  <option   value="this_week">هذا إسبوع</option>
                  <option   value="last_week">فترة اسبوعين </option>
                  <option   value="this_month">هذا الشهر</option>
                  <option   value="last_month">فترة شهرين</option>
                  <option   value="this_year">هذا العام</option>
                  <option   value="last_year">فترة عامين</option>
               </select>
            </div>
         </div>

         <div class="col-md-2">
            <div class="form-group">
               <label> .</label></br>
               <button type="post" class="btn btn-sm btn-info custom_button">طباعة البحث</button>
            </div>
         </div>

        

      </div>
      </form>



      <div class="card-body" id="attendence_ajax_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>   الإسم </th>
               <th>   إسم البصمة </th>
               <th>     اليوم    </th>
               <th>     التاريخ    </th>
               <th>      الزمن  </th>
               <th>    حالة البصمة    </th>
               {{-- <th></th> --}}
            </thead> 
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  @if(@isset($info->Admin) and !@empty($info->Admin) )
                  <td style="background-color: CornflowerBlue;color:white">{{ $info->Admin->name }}</td>
                  @else
                  <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
                  @endif
                  <td>{{ $info->sName }}</td>
                  <td>{{ \Carbon\Carbon::parse($info->Date)->format('l')}}</td>
                  <td>{{ $info->Date }}</td>

                  <td> 
                     @php
                     $time=date("h:i",strtotime($info->Time));
                     $newDateTime=date("A",strtotime($info->Time));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $time }}
                     {{ $newDateTimeType }}   
                  </td>

   
                  {{-- <td>{{ $info->Time }}</td> --}}

                  <td 
                  @if ($info->AttendanceStatus=="checkIn") class="text-success" @else class="text-danger"  @endif > @if ($info->AttendanceStatus=="checkIn")  دخول @else  خروج  
                  @endif
                  </td>

                  {{-- <td>{{ $info->AttendanceStatus }}</td> --}}


                




            

                  {{-- <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) تعمل @elseif ($info->vechile_status==0) متعطلة @else داخل الصيانة @endif</td> --}}
                  
                  {{-- <td>
                     <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                  </td> --}}
                  
               </tr>
               {{-- //////////////////////////////////////////////////////////// --}}

               {{-- ///////////////////////////////////////////////////////////////// --}}

             
               @endforeach
            </tbody>
         </table>
         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>

{{-- ====================================================================================================== --}}
<div class="modal fade  "   id="add_permission_modal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">               اضافة صلاحية مهام </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="InvoiceModalActiveDetailsBody" style="background-color: white !important; color:black;">

         
               <div class="col-md-12">
                  <div class="form-group">
                     <label>     اسم الصلاحية </label>
                     <input  type="text" name="permission_name_modal" id="permission_name_modal" class="form-control" value="" placeholder="أدخل  اسم الصلاحية"  >
                     @error('name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
       
   
               
               <div class="col-md-12">
                  <div class="form-group text-center">
                     <button id="do_add_permission" class="btn btn-sm btn-primary" type="button"  name="submit">اضافة  </button>
                  </div>
               </div>


            </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

{{-- ====================================================================================================== --}}
{{-- ===================================================== --}}
<div class="modal fade  "   id="load_add_permission_roles_sub_menuModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة صيانة للمركبة</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_permission_roles_sub_menuModalBody"  style="background-color: white !important; color:black;">


         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
{{-- ===================================================== --}}
{{-- ====================================================================================================== --}}
<div class="modal fade  "   id="edit_permission_modal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">               تعديل صلاحية مهام </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="edit_permission_modalBody" style="background-color: white !important; color:black;">

         
               <div class="col-md-12">
                  <div class="form-group">
                     <label>     اسم الصلاحية </label>
                     <input  type="text" name="permission_name_modal" id="permission_name_modal" class="form-control" value="" placeholder="أدخل  اسم الصلاحية"  >
                     @error('name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
       
   
               
               <div class="col-md-12">
                  <div class="form-group text-center">
                     <button id="do_add_permission" class="btn btn-sm btn-primary" type="button"  name="submit">اضافة  </button>
                  </div>
               </div>


            </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

{{-- ====================================================================================================== --}}


@endsection

@section("script")
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script src="{{ secure_asset('assets/admin/js/administrative_attendence.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection

