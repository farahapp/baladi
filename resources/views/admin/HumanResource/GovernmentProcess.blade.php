@extends('layouts.admin')
@section('title')
Staff
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
Staff
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   Staff   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Staff Data    
         </h3>
      </div>

      <form method="POST" action="{{ route('GovernmentProcess.print_GovernmentProcess_search') }}" target="_blank">
         @csrf
         <input type="hidden" id="ajax_search_load_add_maintenance_to_vehicle" value="{{route('Maintenance.load_add_maintenance_to_vehicle')}}">
         <input type="hidden" id="token_search" value="{{csrf_token()}}">
         <input type="hidden" id="ajax_update_driver_residency_process_status" value="{{route('GovernmentProcess.ajax_update_driver_residency_process_status')}}">
         <input type="hidden" id="ajax_update_driver_bank_process" value="{{route('GovernmentProcess.ajax_update_driver_bank_process')}}">
         <input type="hidden" id="ajax_update_Functional_status" value="{{route('GovernmentProcess.ajax_update_Functional_status')}}">
         <input type="hidden" id="ajax_search_url" value="{{route('HumanResource.ajax_search_GovernmentProcess')}}">
         <input type="hidden" id="ajax_do_add_permission" value="{{route('Maintenance.ajax_do_add_permission')}}">
         <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
         <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
         <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
              

      <div class="row" style="padding: 5px;">

         <div class="col-md-3">
            <div class="form-group">
               <label>  Search by name  </label>
               <input type="text"  autofocus name="search_by_text" id="search_by_text" class="form-control" value="" placeholder="بحث بالاسم">
            </div>
         </div>

      



         <div class="col-md-3">
            <div class="form-group">
               <label> البحث  بالحالة الوظيفية  </label>
               <select   name="Functional_status_search" id="Functional_status_search" class="form-control">
                  <option  value="all">البحث بالكل </option>
                  <option   @if(old('Functional_status',$data['Functional_status'])==1) selected @endif  value="1">تحت التدريب</option>
                  <option   @if(old('Functional_status',$data['Functional_status'])==2 and old('Functional_status',$data['Functional_status'])!="") selected @endif  value="2"> التشغيل</option>
                  <option   @if(old('Functional_status',$data['Functional_status'])==3 and old('Functional_status',$data['Functional_status'])!="") selected @endif  value="3"> اداري</option>
                  <option @if(old('Functional_status',$data['Functional_status'])==0 and old('Functional_status',$data['Functional_status'])!="" ) selected @endif value="0">خارج العمل</option>
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





      <div class="card-body" id="GovernmentProcess_ajax_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead" style="background-color: purple;color:white">
               <th>   Number </th>
               <th>   Name </th>
               
               <th>  Functional_status </th>
               
               
               {{-- <th></th> --}}
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->id }}</td>
                  <td>{{ $info->driver_name }}</td>
                  {{-- <td>{{ $info->vechile_type }}</td> --}}
                 

                



                



                  <td>
                     <select   name="Functional_status" id="Functional_status" driver_id_value="{{ $info->id }}" class="form-control"
                        isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                        isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
                        <option   @if(old('Functional_status',$info['Functional_status'])==1) selected @endif  value="1">تحت التدريب</option>
                        <option   @if(old('Functional_status',$info['Functional_status'])==2 and old('Functional_status',$info['Functional_status'])!="") selected @endif  value="2"> التشغيل</option>
                        <option   @if(old('Functional_status',$info['Functional_status'])==3 and old('Functional_status',$info['Functional_status'])!="") selected @endif  value="3"> اداري</option>
                        <option @if(old('Functional_status',$info['Functional_status'])==0 and old('Functional_status',$info['Functional_status'])!="" ) selected @endif value="0">خارج العمل</option>
                      </select>
                  </td>

                 
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
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/government_process.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   $(document).on('change','#driver_residency_process_status', function(e){
      var driver_residency_process_status = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driver_residency_process_status").val();
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
         driver_residency_process_status: driver_residency_process_status,
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
});

$(document).on('change','#driver_bank_process', function(e){
      var driver_bank_process = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driver_bank_process").val();
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
         driver_bank_process: driver_bank_process,
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
});


$(document).on('change','#Functional_status', function(e){
      var Functional_status = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_Functional_status").val();
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
         Functional_status: Functional_status,
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
});



</script>
@endsection

