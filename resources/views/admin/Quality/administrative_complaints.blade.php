@extends('layouts.admin')
@section('title')
Quality
@endsection
@section('contentheader')
Administrative complaints
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">Administrative complaints</a>
@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">   Administrative complaints 
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_complaint_status" value="{{route('Quality.ajax_update_complaint_status')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Quality.complaints_ajax_search')}}">
            {{-- <a href="{{ route('Maintenance.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a> --}}
         </h3>
      </div>

      <div class="row" style="padding: 5px;">

        
         <div class="col-md-4">
            <div class="form-group">
               <label>  Search by name </label>
               <select name="search_by_text" id="search_by_text" class="form-control select2 ">
                  <option  value="all">All</option>
                  @if (@isset($admins) && !@empty($admins))
                  @foreach ($admins as $info )
                  <option value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
               @error('search_by_text')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label> Search by complaint date </label>
               <input type="date" id="complaint_date_search"  class="form-control" value="{{ old('complaint_date_search') }}" placeholder="بحث بالاسم">
            </div>
         </div>



         <div class="col-md-3">
            <div class="form-group">
               <label> Search by complaint status </label>
               <select    name="complaint_status_search" id="complaint_status_search" class="form-control">
                  <option  value="all">All </option>
                  <option    value="0">Not reviewed   </option>
                  <option   value="1"> reviewed </option>
                  </select>
            </div>
         </div>
        


      </div>

      <div class="card-body" id="daily_report_ajax_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         @foreach ( $data as $info )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>      Date </th>
               <th>     Name </th>
               <th>     Complaint Title   </th>
               <th>    Complaint Status     </th>
            </tr>
            </thead>
            <tbody>
               <tr>
                  <td>{{ $info->date }}</td>
                  <td style="background-color: brown;color:white">{{ $info->added->name }}</td>
                  <td>{{ $info->complaint_title }}</td>

                  <td> 
                     <select    name="complaint_status" id="complaint_status" complaint_id_value="{{ $info->id }}" class="form-control">
                     <option  @if(old('complaint_status',$info->complaint_status)==0) selected  @endif  value="0"> Not reviewed    </option>
                     <option @if(old('complaint_status',$info->complaint_status)==1) selected @endif  value="1">  reviewed </option>
                     </select>
                  </td> 

                 
               </tr>
            
            </br>
            <tr>
               <td  colspan="4" style="text-align: center">
                  {{ $info->complaint }}
               </td>
            </tr>

                  
             
            </tbody>
         </table>
      </section>
   </main>
         @endforeach

         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center">Sorry, there are no reports for today.</p>
         @endif
      </div>
   </div>
</div>

{{-- ====================================================================================================== --}}



{{-- ====================================================================================================== --}}


@endsection


@section('script')
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ secure_asset('assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ secure_asset('assets/admin/js/complaints.js') }}"></script>


<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   
  
$(document).on('change','#complaint_status', function(e){
   var complaint_status = $(this).val();
   var complaint_id_value=$(this).attr("complaint_id_value");
var token_search = $("#token_search").val();
 var ajax_url = $("#ajax_update_complaint_status").val();
jQuery.ajax({
     url: ajax_url,
     type: 'post',
     dataType: 'html',
     cache: false,
     data: {
      complaint_status: complaint_status,
      complaint_id_value: complaint_id_value,
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


