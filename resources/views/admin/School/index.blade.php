@extends('layouts.admin')
@section('title')
المدرسة
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
المتدربين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   المتدربين   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات   المتدربين
         </h3>
      </div>



      <form method="POST" action="{{ route('School.print_School_search') }}" target="_blank">
         @csrf

            <input type="hidden" id="ajax_search_load_add_maintenance_to_vehicle" value="{{route('Maintenance.load_add_maintenance_to_vehicle')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_driving_school_status" value="{{route('School.ajax_update_driving_school_status')}}">
            <input type="hidden" id="ajax_update_driving_traning_range" value="{{route('School.ajax_update_driving_traning_range')}}">
            <input type="hidden" id="ajax_update_driver_school_notes" value="{{route('School.ajax_update_driver_school_notes')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('School.ajax_search')}}">
            <input type="hidden" id="ajax_do_add_permission" value="{{route('Maintenance.ajax_do_add_permission')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">

            
      <div class="row" style="padding: 5px;">

         <div class="col-md-3">
            <div class="form-group">
               <label>  بحث بالسائق </label>
               <input type="text"  autofocus name="search_by_text" id="search_by_text" class="form-control" value="" placeholder="بحث بالاسم">
            </div>
         </div>

         <div class="col-md-6">
            <div class="form-group">
               <label> البحث عن طريق حالة المدرسة </label>
               <select name="driving_school_status_search[]" multiple id="driving_school_status_search" class="form-control select2 ">
                  {{-- <option  value="all">البحث بالكل </option> --}}
                  @if (@isset($other['driving_school_status']) && !@empty($other['driving_school_status']))
                  @foreach ($other['driving_school_status'] as $info )
                  <option @if(old('permission_main_menues_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{$info->name}} </option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div>
        

         <div class="col-md-3">
            <div class="form-group">
               <label> البحث  بالحالة الوظيفية  </label>
               <select   name="Functional_status_search" id="Functional_status_search" class="form-control">
                  <option  value="all">البحث بالكل </option>
                  <option   selected value="1">تحت التدريب</option>
                  <option     value="2"> التشغيل</option>
                  <option     value="3"> اداري</option>
                  <option     value="0">خارج العمل</option>
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


      <div class="card-body" id="driving_school_status_searchDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead" style="background-color: purple;color:white">
               <th>   الرقم </th>
               <th>   الإسم </th>
               <th>     حالة المدرسة  </th>
               <th>    تقيم مدرب القيادة    </th>
               <th>      ملاحظات    </th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ (($data->firstItem() + $loop->index))  }}</td>
                  <td>{{ $info->driver_name }}</td>

                    <td>
                        <select  name="driving_school_status" id="driving_school_status" driver_id_value="{{ $info->id }}" class="form-control select2 "
                           isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                           isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
                           @if (@isset($other['driving_school_status']) && !@empty($other['driving_school_status']))
                           @foreach ($other['driving_school_status'] as $driving_school )
                           <option @if(old('driving_school_status',$info->driving_school_status)==$driving_school->id) selected="selected" @endif value="{{ $driving_school->id }}" > {{ $driving_school->name }} </option>
                           @endforeach
                           @endif
                        </select>
                     </td>


                  <td> 
                     <select    name="driving_traning_range" id="driving_traning_range" driver_id_value="{{ $info->id }}" class="form-control"
                        isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                        isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                     <option  @if(old('driving_traning_range',$info->driving_traning_range)==0) selected  @endif  value="0">لم يبداء</option>
                     <option @if(old('driving_traning_range',$info->driving_traning_range)==1) selected @endif  value="1">ممتاز</option>
                     <option @if(old('driving_traning_range',$info->driving_traning_range)==2 ) selected @endif value="2">جيد جدا</option>
                     <option @if(old('driving_traning_range',$info->driving_traning_range)==3 ) selected @endif value="3">مقبول</option>
                     <option @if(old('driving_traning_range',$info->driving_traning_range)==4 ) selected @endif value="4">سيئ</option>
                     <option @if(old('driving_traning_range',$info->driving_traning_range)==5 ) selected @endif value="5">سيئ جدا </option>
                     </select>
                  </td> 

                  
                  <td> 
                  <input  type="text" name="driver_school_notes" id="driver_school_notes" driver_id_value="{{ $info->id }}" oninput="change();" class="form-control" value="{{ old('driver_school_notes',$info->driver_school_notes) }}" placeholder="ملاحظات" 
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
                  </td> 



                 
                  <td>
                     <a  href="{{ route('School.edit',$info->id) }}" class="btn btn-primary btn-sm"> الملف الشخصي</a>
                  </td>

                  
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
<script  src="{{ secure_asset('assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ secure_asset('assets/admin/js/school.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   $(document).on('change','#driving_school_status', function(e){
      var driving_school_status = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driving_school_status").val();
      if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         driving_school_status: driving_school_status,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
   //  else{
   //    alertify.set('notifier','position','top-right');
   //       alertify.success("يجب تسليم الجواز وتوقيع جميع العقود ");
   //  }

});

$(document).on('change','#driving_traning_range', function(e){
      var driving_traning_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driving_traning_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         driving_traning_range: driving_traning_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});




//setup before functions
var typingTimer;
$(document).on('keyup','#driver_school_notes', function(e){
   var driver_school_notes = $(this).val();
   var driver_id_value=$(this).attr("driver_id_value");
   var isGivePassPort=$(this).attr("isGivePassPort");
   var isSigningMainContract=$(this).attr("isSigningMainContract");
   var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
   var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");

   var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driver_school_notes").val();

    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
     // alertify.error(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   
 clearTimeout(typingTimer);
 typingTimer =  setTimeout(function () {
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         driver_school_notes: driver_school_notes,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
         }, 2000);
      }
});

$(document).on('keydown','#driver_school_notes', function(e){
 clearTimeout(typingTimer);
});



</script>
@endsection

