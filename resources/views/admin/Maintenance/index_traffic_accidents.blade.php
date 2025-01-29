@extends('layouts.admin')
@section('title')
Traffic Accidents
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
Traffic Accidents
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   Traffic Accidents   </a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Traffic Accidents Data 
            <input type="hidden" id="ajax_load_add_traffic_accidents" value="{{route('Maintenance.ajax_load_add_traffic_accidents')}}">
            <input type="hidden" id="ajax_search_load_add_traffic_accident_parts" value="{{route('Maintenance.load_add_traffic_accident_parts')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Maintenance.ajax_search')}}">
            {{-- <input type="hidden" id="add_traffic_accident" value="{{route('Maintenance.add_traffic_accident')}}"> --}}
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
            {{-- <a href="{{ route('Maintenance.create') }}" class="btn btn-sm btn-warning">Add new</a> --}}
         </h3>
      </div>

      <div class="row" style="padding: 5px;">



         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="vechile_no"> plate number
            <input type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> Car driver
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>


      

   

      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle model </label>
            <select name="vechile_model_search" id="vechile_model_search" class="form-control select2 ">
               <option  value="all">Search all </option>
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

      <div class="card-body" id="Vechile_Information_ajax_serachDiv" style="background-size: cover; background-image: url('{{ asset('/../assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2" >
            <thead>
               <tr>
               <th>    plate number </th>
               {{-- <th>    نوع المركبة  </th> --}}
               <th>     Vehicle Model </th>
               <th>    License Expiry Date  </th>
               <th>    Insurance Expiry Date  </th>
               <th>    Car driver  </th>
               <th>   vehicle status</th>
               {{-- <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th> --}}
               {{-- <th></th> --}}
               <tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td >{{ $info->vechile_no }}</td>
                  {{-- <td>{{ $info->vechile_type }}</td> --}}
                  <td>{{ $info->Vechile_Model->name }}</td>
                  <td>{{ $info->vechile_end_registeration }}</td>
                  <td>{{ $info->insurance_ending_date }}</td>
                   {{-- @if ($info->vechile_driver==null||$info->vechile_driver =='') --}}
                   @if (@isset($info->vechile_driver) && !@empty($info->vechile_driver))
                   <td>{{ $info->VechileDriver->driver_name }} </td>
                   @else
                   <td>nothing </td>
                   @endif
                  <td @if ($info->vechile_status==1) style="color:green"@else style="color:red"  @endif > @if ($info->vechile_status==1) running @elseif ($info->vechile_status==0) broken down @else in maintenance @endif</td>
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
                  {{-- <td>
                     <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">Edit</a>
                     <a href="{{ route('Maintenance.destroy',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">Delete</a>
                  </td> --}}
               </tr>
               {{-- //////////////////////////////////////////////////////////// --}}
               <tr>
                  <td colspan="7">

                     <p style="text-align: center;font-size: 1.4vw; color:brown">Traffic accidents that happened to this vehicle
                        <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_traffic_accidents btn-info" >Add Traffic Accidents</button>
                     </p>
                     
                     @foreach ( $Vechile_Accidents as $accidentVal )

                     @if(@isset($Vechile_Accidents) and !@empty($Vechile_Accidents) and $accidentVal['vehicle_id'] ==  $info->id )
                  <table>
                     <thead style="color:brown">
                        <th>    Accident Description</th>
                        {{-- <th>   القائمة الرئيسية</th> --}}
                        <th>   Accident Place</th>
                        <th>    Accident  fault  person</th>
                        <th>   Accident Date </th>
                        <th></th>
                     </thead>
                     <tbody>
               
                        {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                        <tr>
                           <td>{{ $accidentVal->description }}</td>
                           <td>{{ $accidentVal->place}}</td>
                           <td @if ($accidentVal->fault_person==1) style="color:green"@else style="color:red"  @endif > @if ($accidentVal->fault_person==0) Baladi driver  @else Other Driver  @endif</td>

                           <td>{{ $accidentVal->date }}</td>
                           {{-- <td>{{ $actionVal->name }}</td> --}}
                           
                           
                           <td>
                              <button data-id="{{ $accidentVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">Edit</button>
                              <a href="{{ route('Maintenance.delete_traffic_accident',$accidentVal->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">Delete</a>
                              {{-- <button data-id="{{ $accidentVal->id }}" class="btn btn-sm btn-danger do_delete_permission_btn">حذف</button> --}}
                              <button data-id="{{ $accidentVal->id }}"  class="btn btn-sm load_add_traffic_accident_parts btn-info" style="background-color: purple;color:white">Add accident damaged Parts </button>
                              {{-- <a href="{{ route('permission_roles.delete_permission_sub_menues',$sub->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a> --}}
                              {{-- <a  href="{{ route('permission_sub_menues.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                           </td>
                        </tr>

                     </tr>
                         {{---------------------------------------------}}
                     <tr>
                        <td  colspan="5" style="text-align: center">
                        @foreach ($Vechile_Accident_Parts as $spare )
                        @if (@isset($Vechile_Accident_Parts) && !@empty($Vechile_Accident_Parts)  &&  $spare->vechile_accident_id == $accidentVal->id )
                        <a href="{{ route('Maintenance.delete_traffic_accident_part',$spare->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">{{ $spare->name."(".$spare->price.")" }}<i class="fa fa-trash " aria-hidden="true"></i></a>
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
<div class="modal fade  "   id="load_add_traffic_accidentsModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            Add traffic Accidents</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_traffic_accidentsModalBody"  style="background-color: white !important; color:black;">


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
<div class="modal fade  "   id="load_add_traffic_accident_partsModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            Add accident part </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_traffic_accident_partsModalBody"  style="background-color: white !important; color:black;">


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
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/maintenance.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection

