@extends('layouts.admin')
@section('title')
Quality
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
Daily Report
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">    Daily Report </a>
@endsection
@section('contentheaderactive')
Daily Report 
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center pb-3 text-success">  Daily Report Data     
            <input type="hidden" id="ajax_search_load_add_maintenance_to_vehicle" value="{{route('Maintenance.load_add_maintenance_to_vehicle')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_driving_school_status" value="{{route('School.ajax_update_driving_school_status')}}">
            <input type="hidden" id="ajax_update_driving_traning_range" value="{{route('School.ajax_update_driving_traning_range')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('School.ajax_search')}}">
            <input type="hidden" id="ajax_do_add_permission" value="{{route('Maintenance.ajax_do_add_permission')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
            {{-- <a href="{{ route('Maintenance.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a> --}}
         </h3>
      </div>

      

      <div class="card-body" id="driving_school_status_searchDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
    
         
         <form action="{{ route('DailyReport.store') }}" method="post" enctype="multipart/form-data">
            @csrf

               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error )
                     <li>{{ $error }}</li>
                        
                     @endforeach
                  </ul>


               </div>
               @endif



         <table class="table" id="table">
            <tr>
               <th>Task</th>
               <th>Task Status</th>
               <th>incompleteness Reasons</th>
               <th>Procedure</th>
            </tr>
            <tr>
               <td data-label="Task"><input type="text" name="inputs[0][name]" value="{{ old('inputs[0][name]') }}" placeholder="Task" class="form-control"></td>

               <td data-label="Task Status">
                  <select  name="inputs[0][report_status]" id="inputs[0][report_status]" class="form-control change-report-status">
                     <option   @if(old('inputs[0][report_status]')==1) selected @endif  value="1">Mission accomplished </option>
                     <option @if(old('inputs[0][report_status]')==0 and old('inputs[0][report_status]')!='') selected @endif value="0">mission not accomplished</option>
                     </select>
               </td>

               <td data-label="incompleteness Reasons"><input type="text" name="inputs[0][non_complete_resone]" value="{{ old('inputs[0][non_complete_resone]') }}" placeholder="incompleteness Reasons" class="form-control"></td>



               <td data-label="Procedure"><button type="button" name="add" id="add" class="btn btn-success">Add Task</button>
            </tr>


         </table>

         <div class="col-md-12 " >
            <div class="form-group">
               <label> note   </label>
               <textarea type="text" name="note" id="note" class="form-control" >
                  {{ old('note') }}

               </textarea>
               @error('note')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         <button type="submit" class="btn btn-primary col-md-2">Submit Report</button>

      </form>


    
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


   // <td>
   //                <select  name="inputs[`+i+`]report_status]" id="inputs[`+i+`][report_status]" class="form-control">
   //                   <option   @if(old('inputs[`+i+`][report_status]')==1) selected @endif  value="1">منجزة </option>
   //                   <option @if(old('inputs[`+i+`][report_status]')==0 and old('inputs[`+i+`][report_status]')!='') selected @endif value="0">لم يتم إنجازها</option>
   //                   </select>
   //             </td>

   //             <td><input type="text" name="inputs[`+i+`][non_complete_resone]" value="{{ old('inputs[`+i+`][non_complete_resone]') }}" placeholder=" أسباب عدم  الإكتمال" class="form-control"></td>



   var i=0;
   $(document).on('click','#add', function(e){
   ++i;
   $('#table').append(`
            <tr>
               <td data-lable=""><input type="text" name="inputs[`+i+`][name]" value="{{ old('inputs[`+i+`][name]') }}"  placeholder="Task" class="form-control"></td>

               <td data-lable="">
                  <select  name="inputs[`+i+`][report_status]" id="inputs[`+i+`][report_status]" non_complete_resoneValue="inputs[`+i+`][report_status]" class="form-control change-report-status">
                     <option   @if(old('inputs[`+i+`][report_status]')==1) selected @endif  value="1">Mission accomplished </option>
                     <option @if(old('inputs[`+i+`][report_status]')==0 and old('inputs[`+i+`][report_status]')!='') selected @endif value="0">mission not accomplished</option>
                     </select>
               </td>


               <td data-lable=""><input type="text" id="inputs[`+i+`][non_complete_resone]" name="inputs[`+i+`][non_complete_resone]" value="{{ old('inputs[`+i+`][non_complete_resone]') }}" placeholder="incompleteness Reasons" class="form-control"></td>
              
               <td data-lable=""><button type="button" class="btn btn-danger remove-table-row">Delete Task</button>
            </tr>

            `);

});

$(document).on('click','.remove-table-row', function(e){
   $(this).parents('tr').remove();
});


// $(document).on('change','.change-report-status', function(e){
//    var non_complete_resoneValue=$(this).attr("non_complete_resoneValue");
//    var val= $('#'+non_complete_resoneValue).val();
//    alert(val);
// });


</script>
@endsection

