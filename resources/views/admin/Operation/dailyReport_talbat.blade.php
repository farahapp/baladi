@extends('layouts.admin')
@section('title')
التشغيل 
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
أداء السائقين اليومي (طلبات)
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Operation.index') }}">  أداء السائقين اليومي (طلبات)     </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات أداء السائقين اليومي (طلبات) 
            <a href="{{ route('Operation.importDailyTalabatReportIndex') }}" class="btn btn-sm btn-warning">تحديث بيانات أداء السائقين اليومي (طلبات) </a>
         </h3>
      </div>

      <style>



.tbl-container {
   max-width: fit-content;
   max-height: fit-content;
}

.tbl-fixed{
   /* overflow-x: scroll; */
   overflow-x: scroll;
   height: fit-content;
  
}

table {
   min-width: max-content;
   border-collapse: separate;
   text-align:center;
   border: 1px solid #ccc;
   font-size: 16px;
}

table th{
   position: sticky;
   top: 0px;
}
      </style>
      <form method="POST" action="{{ route('Operation.print_daily_report') }}" target="_blank">
         @csrf

         <input type="hidden" id="token_search" value="{{csrf_token()}}">
         <input type="hidden" id="ajax_search_url" value="{{route('Operation.daily_report_ajax_search')}}">

      <div class="row" style="padding: 5px;">
         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> سائق المركبة
            <input type="radio" name="searchbyradio" value="vechile_no"> رقم اللوحة
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label>بحث من تاريخ </label>
            <input type="date" class="form-control" name="daily_report_date_from" id="daily_report_date_from" value="">
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label>بحث الى تاريخ </label>
            <input type="date" class="form-control" name="daily_report_date_to" id="daily_report_date_to" value="">
         </div>
      </div>

         <div class="col-md-3">
            <div class="form-group">
               <label> بحث عن طريق </label>
               <select  name="search_type" id="search_type" class="form-control">
                  <option   value="">اختار طريقة البحث</option>
                  <option   value="last_batch">التقييم</option>
                  <option   value="actual_working">ساعات العمل</option>
                  <option   value="orders">عدد الطلبات</option>
                  <option   value="loss_orders">الطلبات الضائعة</option>
                  <option   value="loss_hours">الساعات الضائعة</option>
                  <option   value="late_login">وصول متاخر</option>
                  <option   value="no_show">غياب بدون عزر</option>
                  <option   value="no_show_execused">غياب بعزر</option>
                  <option   value="oerders">نسبة الطلبات</option>
               </select>
            </div>
         </div>


         <div class="col-md-3 related_search_type" style="display: none">
            <div class="form-group">
               <label>أقل قيمة للبحث   </label>
               <input type="text" class="form-control" name="min_value" id="min_value" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="">
            </div>
         </div>


         <div class="col-md-3 related_search_type" style="display: none">
            <div class="form-group">
               <label>  أعلى قيمة للبحث </label>
               <input type="text" class="form-control" name="max_value" id="max_value" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="">
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




      <div class="container tbl-container" id="ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <div class="row tbl-fixed">
         <table id="example2" class="table-striped table-condensed">
            <thead class="custom_thead" style="background-color: Maroon;color:white">
               <th>   الرقم </th>
               <th>   التاريخ </th>
               <th>   الإسم </th>
               <th class="verticalTableHeader">   رقم <br> طلبات </th>
               <th class="verticalTableHeader">   التقيم </th>
               <th class="verticalTableHeader">   ساعات <br> العمل </th>
               <th class="verticalTableHeader">   عدد <br> الطلبات </th>
               <th class="verticalTableHeader">   الطلبات <br> الضائعة  </th>
               <th class="verticalTableHeader">   الساعات <br> الضائعة  </th>
               <th class="verticalTableHeader">   وصول <br> متاخر  </th>
               <th class="verticalTableHeader">    غياب <br> بدون عذر </th>
               <th class="verticalTableHeader">    غياب <br>بعذر </th>
               <th class="verticalTableHeader">    نسبة <br>الطلبات </th>
               <th class="verticalTableHeader">   ملاحظات </th>

              
               {{-- <th></th> --}}
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ (($data->firstItem() + $loop->index))  }}</td>
                  <td style="background-color: #1b6535;color:white">{{ $info->date}}</td>
                  @if(@isset($info->Employee) and !@empty($info->Employee) )
                  <td style="background-color: Brown;color:white">{{ $info->Employee->driver_name }}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->Employee->operating_talabat_no}}</td>
                  @else
                  <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
                  @endif

                  <td style="background-color: #1b6535;color:white">{{ $info->last_batch}}</td>
                  <td style="background-color: #e1dd72;color:black">{{ $info->actual_working}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->orders}}</td>
                  <td style="background-color: #1b6535;color:white">{{ $info->loss_orders}}</td>
                  <td style="background-color: #e1dd72;color:black">{{ $info->loss_hours}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->late_login}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->no_show}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->no_show_execused}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->oerders}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->noets}}</td>

                 
                 

                




            

               
                  
               </tr>
            
             
               @endforeach
            </tbody>
         </table>
         </div>
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
<script  src="{{ secure_asset('assets/admin/js/operation_daily_report.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   $(document).on('change','#search_type',function(e){
 if($(this).val()=='' ){
$(".related_search_type").hide();

var $min_value= $("#min_value");
var $max_value= $("#max_value");
$min_value.val('');
$max_value.val('');

}else{
   $(".related_search_type").show();

 }

   });

</script>

@endsection