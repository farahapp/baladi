@extends('layouts.admin')
@section('title')
Guard
@endsection
@section('contentheader')
Uniform
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   Uniform   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Uniform Data     
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_report_status" value="{{route('uniform.ajax_update_report_status')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('uniform.ajax_daily_report_search')}}">
            <input type="hidden" id="ajax_do_add_report_note" value="{{route('DailyReport.ajax_do_add_report_note')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
            {{-- <a href="{{ route('Maintenance.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a> --}}
         </h3>
      </div>

      <div class="row" style="padding: 5px;">

        
      
         <div class="col-md-3">
            <div class="form-group">
               <input checked type="radio" name="searchbyradio" id="searchbyradio" value="baladi_id"> Baladi Id
            <input  type="radio" name="searchbyradio" value="name"> Name
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> Phone
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>


         <div class="col-md-3">
            <div class="form-group">
               <label> Search by uniform Date </label>
               {{-- @if(@isset($data) and !@empty($data) and count($data)>0 ) --}}
               <input type="date" id="report_date_search"   class="form-control" value="" placeholder="بحث بالاسم">
               {{-- @else
               <input type="date" id="report_date_search"  class="form-control" value="{{ old('report_date_search',$today) }}" placeholder="بحث بالاسم">
               @endif --}}
            </div>
         </div>


         <div class="col-md-4">
            <div class="form-group">
               <label>  Search by Clothing Supervisor </label>
               <select name="search_by_supervisor" id="search_by_supervisor" class="form-control select2 ">
                  <option  value="all">All  </option>
                  @if (@isset($admins) && !@empty($admins))
                  @foreach ($admins as $info )
                  <option value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
               @error('search_by_supervisor')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label> Search By uniform Status  </label>
               <select    name="report_status_search" id="report_status_search" class="form-control">
                  <option  value="all">All</option>
                  <option   value="0">Not Returned uniform</option>
                  <option    value="1">Returned uniform</option>
                  </select>
            </div>
         </div>
        


      </div>

      <div class="card-body" id="daily_report_ajax_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         @foreach ( $data as $info )
         <table id="example2">
            <thead>
               <th>Driver Name</th>
               <th>Date</th>
               <th>Notes</th>
               <th>Clothing Supervisor</th>
               <th>Uniform Status</th>
               <th></th>
            </thead>
            <tbody>
               <tr>
                  <td style="background-color: CornflowerBlue;color:white">{{ $info->driver->driver_name }}</td>
                  {{-- <td>{{ $info->vechile_type }}</td> --}}
                  <td>{{ $info->date }}</td>

                  <td>{{ $info->note }}</td>

                  <td style="background-color: CornflowerBlue;color:white">{{ $info->added->name }}</td>

                  <td> 
                     <select    name="report_status" id="report_status" report_id_value="{{ $info->id }}" class="form-control">
                     <option  @if(old('report_status',$info->report_status)==0) selected  @endif  value="0">Not Returned uniform </option>
                     <option @if(old('report_status',$info->report_status)==1) selected @endif  value="1">Returned uniform</option>
                     </select>
                  </td> 

                  <td>
                     <a style="color:white" class="btn btn-info btn-sm load_add_note_btn">Supervisor notes </a>
                  </td>

               </tr>

                   {{-- //////////////////////////////////////////////////////////// --}}
                   <tr>
                     <td colspan="7">
   
                        {{-- <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
                           <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
                        </p> --}}
                        
                        @foreach ( $dailyEmployeesReportTasks as $dailyTasksVal )
   
                        @if(@isset($dailyEmployeesReportTasks) and !@empty($dailyEmployeesReportTasks) and $dailyTasksVal['daily_employees_report_id'] ==  $info->id )
                     <table>
                        <thead style="color:brown">
                           <th>     Deposit Name </th>
                           <th>      Deposit Size  </th>
                           <th>    Deposit Amount       </th>
                        </thead>
                        <tbody>
                  
                           {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                           <tr>
                              <td style="background-color: brown;color:white">{{ $dailyTasksVal->name }}</td>

                              {{-- <td 
                              @if ($dailyTasksVal->report_status==1) class="text-success" @else class="text-danger"  @endif >
                              @if ($dailyTasksVal->report_status==1) Returned Deposit 
                              @elseif ($dailyTasksVal->report_status==0) Returned Deposit 
                              @endif --}}

                              
                              <td>{{ $dailyTasksVal->size }}</td>
                              <td>{{ $dailyTasksVal->amount }}</td>
                              
                           </tr>
   
                        </tr>
                          
   
                        </tbody>
                     </table>
   
                     @else
                     {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
                     @endif
                     @endforeach
   
                        </td>
                        </tr>
   
   
                  {{-- ///////////////////////////////////////////////////////////////// --}}
   

             
            </tbody>
         </table>
         @endforeach

         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> Sorry, there are no deposits for today</p>
         @endif
      </div>
   </div>
</div>

{{-- ====================================================================================================== --}}
<div class="modal fade  "   id="add_note_modal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">Add Deposits Notes</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="InvoiceModalActiveDetailsBody" style="background-color: white !important; color:black;">

         
               <div class="col-md-12 " >
                  <div class="form-group">
                     <label>  Deposits Notes  </label>
                     <textarea type="text" name="report_note" id="report_note" class="form-control" >
                        {{ old('report_note') }}
      
                     </textarea>
                     @error('report_note')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
       
   
               
               <div class="col-md-12">
                  <div class="form-group text-center">
                     <button id="do_add_permission" class="btn btn-sm btn-primary" type="button"  name="submit">Add  </button>
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


@section('script')
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/show_unform_drivers.js') }}"></script>


<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   
  
$(document).on('change','#report_status', function(e){
   var report_status = $(this).val();
   var report_id_value=$(this).attr("report_id_value");
var token_search = $("#token_search").val();
 var ajax_url = $("#ajax_update_report_status").val();
jQuery.ajax({
     url: ajax_url,
     type: 'post',
     dataType: 'html',
     cache: false,
     data: {
      report_status: report_status,
      report_id_value: report_id_value,
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


