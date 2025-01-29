@extends('layouts.admin')
@section('title')
التسويق
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
التقديم الداخلي
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Marketing.index') }}">   مقدمي الطلب   </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات   مقدمي الطلب 
            <input type="hidden" id="ajax_search_load_add_maintenance_to_vehicle" value="{{route('Maintenance.load_add_maintenance_to_vehicle')}}">
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_driving_school_status" value="{{route('School.ajax_update_driving_school_status')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Marketing.ajax_search')}}">
            <input type="hidden" id="ajax_do_add_permission" value="{{route('Maintenance.ajax_do_add_permission')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('Maintenance.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('Maintenance.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('Maintenance.ajax_do_delete_permission')}}">
            <a href="{{ route('Marketing.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
         </h3>
      </div>

      <div class="row">

         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="name"> بالإسم
            <input type="radio" name="searchbyradio" id="searchbyradio" value="id_number"> بالاقامة
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> بالهاتف

            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

         <div class="col-md-3">
            <div class="form-group">
               <label>بحث من تاريخ </label>
               <input type="date" class="form-control" name="registeration_date_from" id="registeration_date_from" value="">
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث الى تاريخ </label>
               <input type="date" class="form-control" name="registeration_date_to" id="registeration_date_to" value="">
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث من عمر </label>
               <input type="text" class="form-control" name="age_from" id="age_from" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="">
            </div>
         </div>


         <div class="col-md-3">
            <div class="form-group">
               <label>بحث الى عمر </label>
               <input type="text" class="form-control" name="age_to" id="age_to" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="">
            </div>
         </div>




        

      </div>

      <div class="card-body" id="marketing_searchDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead" style="background-color: purple;color:white">
               <th>   الرقم </th>
               <th>   الإسم </th>
               <th>       رقم الاقامة   </th>
               <th>      العمر   </th>
               <th>     رقم الهاتف   </th>
               <th>     رخصة سودانية   </th>
               <th>    تاريخ التسجيل      </th>
               
            
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->id }}</td>
                  <td>{{ $info->name }}</td>
                  <td>{{ $info->id_number }}</td>
                  <td>{{ $info->age }}</td>
                  <td>{{ $info->phone_number }}</td>
                  <td 
                  @if ($info->does_has_sudanese_Driving_License==1) class="text-success" @else class="text-danger"  @endif > @if ($info->does_has_sudanese_Driving_License==1) توجد @else لا توجد  
                  @endif
                  </td>
                  <td>{{ $info->registeration_date }}</td>
                 


                  




                 



                 


                 
                  <td>
                     <a  href="{{ route('Marketing.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
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
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/marketing.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   $(document).on('change','#driving_school_status', function(e){
      var driving_school_status = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
//alert("driver_id_value="+driver_id_value+"and driving_school_status="+driving_school_status)
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_driving_school_status").val();
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
});


</script>
@endsection

