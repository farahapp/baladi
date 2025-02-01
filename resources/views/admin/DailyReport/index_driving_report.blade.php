@extends('layouts.admin')
@section('title')
الجودة
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
التقرير اليومي لتدريب القيادة 
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   التقرير اليومي  </a>
@endsection
@section('contentheaderactive')
التقرير  اليومي  
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center pb-3 text-success">  بيانات   التقرير اليومي لتدريب القيادة
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
    
         
         <form action="{{ route('DailyReport.store_driving_report') }}" method="post" enctype="multipart/form-data">
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



            <table class="table table-bordered" id="table">
               <tr>
                  <th>اسم المتدرب</th>
                  <th>تقييم المتدرب</th>
                  <th> ملاحظات على المتدرب  </th>
                  <th>الإجراء</th>
               </tr>


             <tr>
               <td>
                  <select  name="inputs[0][driver_id]" id="inputs[0][driver_id]"  class="form-control select2 ">
                     @if (@isset($data) && !@empty($data))
                     @foreach ($data as $driving_student )
                     <option @if(old('inputs[0][driver_id]')==$driving_student->id) selected="selected" @endif value="{{ $driving_student->id }}" > {{ $driving_student->driver_name }} </option>
                     @endforeach
                     @endif
                  </select>
               </td>

               <td> 
                  <select    name="inputs[0][driver_range]" id="inputs[0][driver_range]"  class="form-control">
                  <option @if(old('inputs[0][driver_range]')==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('inputs[0][driver_range]')==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('inputs[0][driver_range]')==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('inputs[0][driver_range]')==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('inputs[0][driver_range]')==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td> 

               <td><input type="text" name="inputs[0][driver_note]" value="{{ old('inputs[0][driver_note]') }}" placeholder="ملاحظات على المتدرب" class="form-control"></td>



               <td><button type="button" name="add" id="add" class="btn btn-success">أضف متدرب</button>
            </tr>


         </table>

         <div class="col-md-12 " >
            <div class="form-group">
               <label> ملاحظات علي التدريب </label>
               <textarea type="text" name="note" id="note" class="form-control" >
                  {{ old('note') }}

               </textarea>
               @error('note')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         <button type="submit" class="btn btn-primary col-md-2">إرسال التقرير</button>

      </form>


    
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





   var i=0;
   $(document).on('click','#add', function(e){
   ++i;
   $('#table').append(`
   <tr>
               <td>
                  <select  name="inputs[`+i+`][driver_id]" id="inputs[`+i+`][driver_id]"  class="form-control select2 ">
                     @if (@isset($data) && !@empty($data))
                     @foreach ($data as $driving_student )
                     <option @if(old('inputs[`+i+`][driver_id]')==$driving_student->id) selected="selected" @endif value="{{ $driving_student->id }}" > {{ $driving_student->driver_name }} </option>
                     @endforeach
                     @endif
                  </select>
               </td>

               <td> 
                  <select    name="inputs[`+i+`][driver_range]" id="inputs[`+i+`][driver_range]"  class="form-control">
                  <option @if(old('inputs[`+i+`][driver_range]')==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('inputs[`+i+`][driver_range]')==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('inputs[`+i+`][driver_range]')==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('inputs[`+i+`][driver_range]')==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('inputs[`+i+`][driver_range]')==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td> 

               <td><input type="text" name="inputs[`+i+`][driver_note]" value="{{ old('inputs[`+i+`][driver_note]') }}" placeholder="ملاحظات على المتدرب" class="form-control"></td>



                  <td><button type="button" class="btn btn-danger remove-table-row">حذف المتدرب</button>

            </tr>

            `);
            $('.select2').select2({
            theme: 'bootstrap4'
          });

});

$(document).on('click','.remove-table-row', function(e){
   $(this).parents('tr').remove();
});





</script>
@endsection

