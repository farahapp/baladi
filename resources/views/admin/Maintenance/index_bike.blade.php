@extends('layouts.admin')
@section('title')
الصيانة
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
الدراجات النارية
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index_bike') }}">   الدراجات النارية   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات   الدراجات النارية 
            <input type="hidden" id="ajax_search_load_add_maintenance_to_vehicle" value="{{route('Maintenance.load_add_maintenance_to_vehicle')}}">
            <input type="hidden" id="ajax_search_load_add_vechile_spare_part" value="{{route('Maintenance.load_add_vechile_spare_part')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Maintenance.ajax_search_bike')}}">
            <input type="hidden" id="ajax_do_add_permission" value="{{route('Maintenance.ajax_do_add_permission')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
            <a href="{{ route('Maintenance.create_bike') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
         </h3>
      </div>

      <div class="row" style="padding: 5px;">



         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="vechile_no"> رقم اللوحة
            <input type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> سائق الدراجة النارية
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>


      

   

      <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق طراز الدراجة النارية </label>
            <select name="vechile_model_search" id="vechile_model_search" class="form-control select2 ">
               <option  value="all">البحث بالكل </option>
               @if (@isset($Vechile_Model) && !@empty($Vechile_Model))
               @foreach ($Vechile_Model as $info)
               <option value="{{ $info->id }}"> {{$info->name}} </option>
               @endforeach
               @endif
            </select>
         </div>
      </div>




         <div class="col-md-3">
            <div class="form-group">
               <label> البحث عن طريق حالة الدراجة النارية </label>
               <select  name="vechile_status_search" id="vechile_status_search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="1">تعمل</option>
               <option  value="0">متعطلة</option>
               <option  value="2">تحت الصيانة</option>
               </select>
            </div>
         </div>
        

      </div>

      <div class="card-body" id="Vechile_Information_ajax_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>    رقم اللوحة </th>
               {{-- <th>    نوع الدراجة النارية  </th> --}}
               <th>     طراز الدراجة النارية </th>
               <th>    تاريخ إنتهاء الترخيص  </th>
               <th>    انتهاء التأمين  </th>
               <th>    سائق الدراجة النارية  </th>
               <th>   حالة الدراجة النارية</th>
               {{-- <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th> --}}
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td style="background-color: aquamarine">{{ $info->vechile_no }}</td>
                  {{-- <td>{{ $info->vechile_type }}</td> --}}
                  <td>{{ $info->Vechile_Model->name }}</td>
                  <td>{{ $info->vechile_end_registeration }}</td>
                  <td>{{ $info->insurance_ending_date }}</td>
                   {{-- @if ($info->vechile_driver==null||$info->vechile_driver =='') --}}
                   @if (@isset($info->vechile_driver) && !@empty($info->vechile_driver))
                   <td>{{ $info->VechileDriver->driver_name }} </td>
                   @else
                   <td>لايوجد </td>
                   @endif
                  <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) تعمل @elseif ($info->vechile_status==0) متعطلة @else داخل الصيانة @endif</td>
                  {{-- <td>
                     @php
                     $dt=new DateTime($info->created_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("a",strtotime($info->created_at));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }} <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->added->name }} 
                  </td>
                  <td>
                     @if($info->updated_by>0)
                     @php
                     $dt=new DateTime($info->updated_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("a",strtotime($info->updated_at));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}  <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->updatedby->name }} 
                     @else
                     لايوجد
                     @endif
                  </td> --}}
                  <td>
                     <a  href="{{ route('Maintenance.edit_bike',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                     <a href="{{ route('Maintenance.destroy',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
                  </td>
               </tr>
               {{-- //////////////////////////////////////////////////////////// --}}
               <tr>
                  <td colspan="7">

                     <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه الدراجة النارية 
                        <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للدراجة النارية</button>
                     </p>
                     
                     @foreach ( $vehicle_Maintenance as $maintenanceVal )

                     @if(@isset($vehicle_Maintenance) and !@empty($vehicle_Maintenance) and $maintenanceVal['vehicle_id'] ==  $info->id )
                  <table class="table table-bordered table-hover">
                     <thead class="" style="background-color: purple;color:white">
                        <th>    اسم الصيانة </th>
                        {{-- <th>   القائمة الرئيسية</th> --}}
                        <th>   تكلفة الصيانة الكلية</th>
                        <th>    ورشة الصيانة </th>
                        <th>  تاريخ الصيانة </th>
                        <th></th>
                     </thead>
                     <tbody>
               
                        {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                        <tr>
                           <td style="background-color: brown;color:white">{{ $maintenanceVal->name }}</td>
                           <td>{{ $maintenanceVal->total_cost."ريال"}}</td>
                           <td>{{ $maintenanceVal->workshop}}</td>
                           <td>{{ $maintenanceVal->date }}</td>
                           {{-- <td>{{ $actionVal->name }}</td> --}}
                           
                           
                           <td>
                              <button data-id="{{ $maintenanceVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">تعديل</button>
                              <a href="{{ route('Maintenance.delete_maintenance_to_vehicle',$maintenanceVal->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a>
                              {{-- <button data-id="{{ $maintenanceVal->id }}" class="btn btn-sm btn-danger do_delete_permission_btn">حذف</button> --}}
                              <button data-id="{{ $maintenanceVal->id }}"  class="btn btn-sm load_add_vechile_spare_part btn-info" style="background-color: purple;color:white">اضافة قطع غيار  </button>
                              {{-- <a href="{{ route('permission_roles.delete_permission_sub_menues',$sub->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a> --}}
                              {{-- <a  href="{{ route('permission_sub_menues.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                           </td>
                        </tr>

                     </tr>
                         {{---------------------------------------------}}
                     <tr>
                        <td  colspan="5" style="text-align: center">
                        @foreach ($Vechile_Spare_Parts as $spare )
                        @if (@isset($Vechile_Spare_Parts) && !@empty($Vechile_Spare_Parts)  &&  $spare->vechile_maintenance_id == $maintenanceVal->id )
                        <a href="{{ route('Maintenance.delete_vechile_spare_part',$spare->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">{{ $spare->name."(".$spare->price." ريال)" }}<i class="fa fa-trash " aria-hidden="true"></i></a>
                        @endif
                        @endforeach
                     </td>
                     </tr>
                        {{---------------------------------------------}}

                     </tbody>
                  </table>

                  @else
                  {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
                  @endif
                  @endforeach

                     </td>
                     </tr>


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
<div class="modal fade  "   id="load_add_maintenance_to_vehicleModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة صيانة للدراجة النارية</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_maintenance_to_vehicleModalBody"  style="background-color: white !important; color:black;">


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
{{-- ===================================================== --}}
<div class="modal fade  "   id="load_add_vechile_spare_partModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة قطع غيار </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_vechile_spare_partModalBody"  style="background-color: white !important; color:black;">


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
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/maintenance.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection