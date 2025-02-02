@extends('layouts.admin')
@section('title')
الجودة
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
التقرير اليومي
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   التقرير اليومي</a>
@endsection
@section('contentheaderactive')
التقرير اليومي
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center pb-3 text-success">  بيانات   التقرير اليومي 
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
         @if(@isset($data) and !@empty($data) )
    
         
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



               <div class="col-md-12" style="text-align: center">
                  <div class="form-group">
                     @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                        <img class="custom_img"  alt="Avatar"  id="showImageView"  src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                        <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">عرض الصورة</button>
                        @endif
                  </div>
                  <label>{{ old('driver_name',$data['driver_name']) }}</label>
               </div>   



         <table class="table" id="table">
            <tr>
               <th>المهمة</th>
               <th>حالة المهمة</th>
               <th>أسباب عدم  الإكتمال</th>
               <th>الإجراء</th>
            </tr>
            <tr>
               <td data-label="المهمة"><input type="text" name="inputs[0][name]" value="{{ old('inputs[0][name]') }}" placeholder=" المهمة" class="form-control"></td>

               <td data-label="حالة المهمة">
                  <select  name="inputs[0][report_status]" id="inputs[0][report_status]" class="form-control change-report-status">
                     <option   @if(old('inputs[0][report_status]')==1) selected @endif  value="1">منجزة </option>
                     <option @if(old('inputs[0][report_status]')==0 and old('inputs[0][report_status]')!='') selected @endif value="0">لم يتم إنجازها</option>
                     </select>
               </td>

               <td data-label="أسباب عدم  الإكتمال"><input type="text" name="inputs[0][non_complete_resone]" value="{{ old('inputs[0][non_complete_resone]') }}" placeholder=" أسباب عدم  الإكتمال" class="form-control"></td>



               <td data-label="الإجراء"><button type="button" name="add" id="add" class="btn btn-success">أضف مهمة</button>
            </tr>


         </table>

        
         <button type="submit" class="btn btn-primary col-md-2">إرسال التقرير</button>

      </form>


    
         <br>

         <br/> 

         <div class="row">
         @foreach ($deposits as $raw)
         <form  method="post">
            {{-- <form  method="post"> --}}
               @csrf
               <div style="border:1px solid #333;
               background-color:#f1f1f1;
               border-radius:5px;padding:16px;margin:6px"
               align="center">
               <img class="custom_img" id="showImageView"  src="{{  $raw['image'] }}"  ><br/>
               <h4 class="text-info">
                  {{ $raw['name'] }}
               </h4>
               <h4 class="text-danger">
                  {{ $raw['size'] }}
               </h4>
               <input type="text" name="quantity"
               value="1" class="form-control" />
               <input type="hidden" name="hidden_name"
               value="{{ $raw['name'] }}" />
               <input type="hidden" name="hidden_size"
               value="{{ $raw['size'] }}" />
               <input type="hidden" name="hidden_id"
               value="{{ $raw['id'] }}" />
               <input type="submit" name="add_to_cart" id="add_to_cart"
               style="btn btn-success" value="Add To Cart" />
             </div>

         </form>

            
         @endforeach
       </div>

         

         <div class="col-md-12 text-center" >
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>



@endsection

@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/school.js') }}"></script>
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
               <td data-lable=""><input type="text" name="inputs[`+i+`][name]" value="{{ old('inputs[`+i+`][name]') }}"  placeholder="المهمة" class="form-control"></td>

               <td data-lable="">
                  <select  name="inputs[`+i+`][report_status]" id="inputs[`+i+`][report_status]" non_complete_resoneValue="inputs[`+i+`][report_status]" class="form-control change-report-status">
                     <option   @if(old('inputs[`+i+`][report_status]')==1) selected @endif  value="1">منجزة </option>
                     <option @if(old('inputs[`+i+`][report_status]')==0 and old('inputs[`+i+`][report_status]')!='') selected @endif value="0">لم يتم إنجازها</option>
                     </select>
               </td>


               <td data-lable=""><input type="text" id="inputs[`+i+`][non_complete_resone]" name="inputs[`+i+`][non_complete_resone]" value="{{ old('inputs[`+i+`][non_complete_resone]') }}" placeholder=" أسباب عدم  الإكتمال" class="form-control"></td>
              
               <td data-lable=""><button type="button" class="btn btn-danger remove-table-row">حذف المهمة</button>
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

