@extends('layouts.admin')
@section('title')
Maintenance
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
Traffic violations
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index_bike') }}">   Traffic violations    </a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Traffic Violations Data 
            <input type="hidden" id="ajax_load_add_traffic_violation" value="{{route('Maintenance.load_add_traffic_violation')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Maintenance.ajax_search_traffic_violations')}}">
            <input type="hidden" id="ajax_update_traffic_violation_payment_status" value="{{route('Maintenance.ajax_update_traffic_violation_payment_status')}}">
         </h3>
      </div>

      <div class="row" style="padding: 5px;">



         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="vechile_no"> plate number 
            <input type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> Vehicle driver 
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle type </label>
            <select  name="vechile_car_or_bike_search" id="vechile_car_or_bike_search" class="form-control">
            <option  value="all">All  </option>
            <option  value="1">Car</option>
            <option  value="2">Bike</option>
            </select>
         </div>
      </div>
      

   

      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle model </label>
            <select name="vechile_model_search" id="vechile_model_search" class="form-control select2 ">
               <option  value="all">All</option>
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
               <label> Search by vehicle status </label>
               <select  name="vechile_status_search" id="vechile_status_search" class="form-control">
                  <option  value="all">Search all </option>
                  <option  value="1">running</option>
                  <option  value="0">broken down</option>
                  <option  value="2">in maintenance</option>
               </select>
            </div>
         </div>
        

      </div>

      <div class="card-body" id="Traffic_Violations_ajax_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>    plate number </th>
               {{-- <th>    نوع المركبة  </th> --}}
               <th>    Vehicle driver  </th>
               <th>    Vehicle type  </th>
               <th>     Vehicle Model </th>
               <th>   vehicle status</th>
               {{-- <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th> --}}
            </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td style="background-color: aquamarine">{{ $info->vechile_no }}</td>
                  {{-- <td>{{ $info->vechile_type }}</td> --}}
                   {{-- @if ($info->vechile_driver==null||$info->vechile_driver =='') --}}
                   @if (@isset($info->vechile_driver) && !@empty($info->vechile_driver))
                   <td>{{ $info->VechileDriver->driver_name }} </td>
                   @else
                   <td>nothing </td>
                   @endif
                   <td @if ($info->vechile_car_or_bike==1) class="text-success" @else class="text-danger"  @endif > @if ($info->vechile_car_or_bike==1) Car @else Bike  @endif</td>
                   <td>{{ $info->Vechile_Model->name }}</td>
                   <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) Running @elseif ($info->vechile_status==0) Broken Down @else In Maintenance @endif</td>
                  {{-- <td>
                     <a  href="{{ route('Maintenance.edit_bike',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                     <a href="{{ route('Maintenance.destroy',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
                  </td> --}}
               </tr>
               {{-- //////////////////////////////////////////////////////////// --}}
               <tr>
                  <td colspan="7">

                     <p style="text-align: center;font-size: 1.4vw; color:brown">Traffic violations for this vehicle 
                        <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_traffic_violation btn-info" >Add a violation to this vehicle</button>
                     </p>
                     
                   
                  <table >
                     <thead style="color:purple">
                        <th>     Violation Name   </th>
                        {{-- <th>   القائمة الرئيسية</th> --}}
                        <th>    Violation Amount </th>
                        <th>  Violation Date  </th>
                        <th>   Violation payment status </th>
                        <th></th>
                     </thead>
                     <tbody>
                        @foreach ( $vechile_Traffic_Violations as $traffic_ViolationVal )

                        @if(@isset($vechile_Traffic_Violations) and !@empty($vechile_Traffic_Violations) and $traffic_ViolationVal['vechile_id'] ==  $info->id )
                        {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                        <tr>
                           <td style="background-color: brown;color:white">{{ $traffic_ViolationVal->traffic_violation_name }}</td>
                           <td>{{ $traffic_ViolationVal->traffic_violation_amount." Qatari Riyal"}}</td>
                           <td>{{ $traffic_ViolationVal->date }}</td>

                         
                           <td>
                              <select   name="traffic_violation_payment_status" id="traffic_violation_payment_status" traffic_violation_id_value="{{ $traffic_ViolationVal->id }}" class="form-control">
                                 <option   @if(old('traffic_violation_payment_status',$traffic_ViolationVal->traffic_violation_payment_status)==0) selected @endif  value="0">Unpaid</option>
                                 <option   @if(old('traffic_violation_payment_status',$traffic_ViolationVal->traffic_violation_payment_status)==1) selected @endif  value="1"> Paid</option>
                               </select>
                           </td>

                           {{-- <td>{{ $traffic_ViolationVal->traffic_violation_payment_status }}</td> --}}



                           {{-- <td>{{ $actionVal->name }}</td> --}}
                           
                           <td>
                              <button data-id="{{ $traffic_ViolationVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">Edit</button>
                              <a href="{{ route('Maintenance.delete_traffic_violations',$traffic_ViolationVal->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">Delete</a>
      
                           </td>
                        </tr>

                     </tr>
                     @else
                     {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
                     @endif
                     @endforeach
                     </tbody>
                  </table>

               

                     </td>
                     </tr>


               {{-- ///////////////////////////////////////////////////////////////// --}}

             
               @endforeach
            </tbody>
         </table>
      </section>
   </main>
         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
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
<div class="modal fade  "   id="load_add_traffic_violationModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            Add a traffic violation  </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_traffic_violationModalBody"  style="background-color: white !important; color:black;">


         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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
            <h4 class="modal-title text-center">            Add Spare Parts </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_vechile_spare_partModalBody"  style="background-color: white !important; color:black;">


         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
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
<script src="{{ secure_asset('assets/admin/js/maintenance_traffic_violation.js') }}"></script>
<script>

   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   
$(document).on('change','#traffic_violation_payment_status', function(e){
      var traffic_violation_payment_status = $(this).val();
      var traffic_violation_id_value=$(this).attr("traffic_violation_id_value");
      var token_search = $("#token_search").val();
      var ajax_url = $("#ajax_update_traffic_violation_payment_status").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         traffic_violation_payment_status: traffic_violation_payment_status,
         traffic_violation_id_value: traffic_violation_id_value,
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
});


</script>
@endsection