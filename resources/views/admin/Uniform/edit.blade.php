@extends('layouts.admin')
@section('title')
Guard
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheader')
Deposit 
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   Deposit </a>
@endsection
@section('contentheaderactive')
Deposit 
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center pb-3 text-success">  Deposit Data     
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

      

      <div class="card-body" id="driving_school_status_searchDiv"  style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) )
    
         
         <div class="col-md-12" style="text-align: center; background-color: #fffb; backdrop-filter: blur(7px);
         box-shadow: 0 .4rem .8rem #0005;
         border-radius: .8rem;overflow: hidden;">
               <div class="form-group">
               @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
               <img style="box-shadow: 0 .4rem .8rem #0005;
        border-radius: .8rem;overflow: hidden;" class="custom_img"  alt="Avatar"  id="showImageView"  src="{{ secure_asset('assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">View image</button>
                  @endif
            </div>
            <label>{{ old('driver_name',$data['driver_name']) }}</label>
         </div>   

         
         <form action="{{ route('uniform.store') }}" method="post" enctype="multipart/form-data">
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


         <main class="table">
            <section class="table__body">
         <table style="display: none"  class="table" id="table">
            <tr>
               <thead>
               <th>Name</th>
               <th>Size</th>
               <th>Amount</th>
               <th></th>
               </thead>
            </tr>
            {{-- <tr>
               <td data-label="المهمة"><input readonly type="text" name="inputs[0][name]" value="{{ old('inputs[0][name]') }}" placeholder=" المهمة" class="form-control"></td>

               <td data-label="حالة المهمة">
                  <select  name="inputs[0][report_status]" id="inputs[0][report_status]" class="form-control change-report-status">
                     <option   @if(old('inputs[0][report_status]')==1) selected @endif  value="1">منجزة </option>
                     <option @if(old('inputs[0][report_status]')==0 and old('inputs[0][report_status]')!='') selected @endif value="0">لم يتم إنجازها</option>
                     </select>
               </td>

               <td data-label="أسباب عدم  الإكتمال"><input readonly type="text" name="inputs[0][non_complete_resone]" value="{{ old('inputs[0][non_complete_resone]') }}" placeholder=" أسباب عدم  الإكتمال" class="form-control"></td>



               <td data-label="الإجراء"><button type="button" name="add" id="add" class="btn btn-success">أضف مهمة</button>
            </tr> --}}


         </table>

         <input type="hidden" name="driver_id" id="driver_id"
         value="{{ $data['id'] }}" />

         <div style="text-align:center">  
         <button style="display: none" type="submit" id="confirm_deposit"name="confirm_deposit" class="btn btn-primary col-md-3">Confirm deposit withdrawal</button>
         </div>
      </section>
   </main>
      </form>


    
         <br>

         <br/> 

         <div class="row">
         @foreach ($deposits as $raw)
         <form  method="post">
            {{-- <form  method="post"> --}}
               @csrf
               <div style="border:1px solid #333;
               background-color:#f1f1f1;text-align: center;
               border-radius:5px;padding:16px;margin:6px"
               align="center;">
               {{-- <img class="custom_img" id="showImageView"  src="{{  $raw['image'] }}"  ><br/> --}}
               <img class="custom_img" id="showImageView" src="{{ secure_asset('assets/admin/uploads').'/'.$raw['image'] }}" alt="صورة  " ><br/>
               <h4 class="text-info">
                  {{ $raw['name'] }}
               </h4>
               <h4 class="text-danger">
                  {{ $raw['size'] }}
               </h4>
               <input style="display: none" type="text" name="quantity" id="quantity"
               value="1" class="form-control" />
               <input type="hidden" name="hidden_name" id="hidden_name"
               value="{{ $raw['name'] }}" />
               <input type="hidden" name="hidden_size" id="hidden_size"
               value="{{ $raw['size'] }}" />
               <input type="hidden" name="hidden_id" id="hidden_id"
               value="{{ $raw['id'] }}" />
               <input type="button" name="add_to_cart" id="add_to_cart"
               deposit_name="{{ $raw['name'] }}"
               deposit_size="{{ $raw['size'] }}"
               deposit_id="{{ $raw['id'] }}"
               style="margin-top:5px" class="btn-success" value="Add Deposit" />
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


{{-- ======================================================================================================================= --}}
<div class="modal fade  "   id="show_imageModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">     عرض الصورة</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div align=center class="modal-body" id="show_imageModalBody"  style="background-color: white !important; color:black;">

            @if (pathinfo($data['visa_image'], PATHINFO_EXTENSION) == 'pdf')
            <iframe style=" width:700px;height: 500px;" id="show_imageModal_Image"  src=""></iframe><br/>
            @else
            <img style=" width:700px;height: 500px;" id="show_imageModal_Image"  src="" alt="الصورة الشخصية للسائق" ><br/>
            @endif
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
 {{-- ======================================================================================================================= --}}

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
   $(document).on('click','#add_to_cart', function(e){

      $("#confirm_deposit").show();
      $('#table').show();

      var deposit_name=$(this).attr("deposit_name");
      var deposit_size=$(this).attr("deposit_size");
      var deposit_id=$(this).attr("deposit_id");
      var quantity = $("#quantity").val();

     // var quantity = document.getElementsByClassName("quantity")[0].value;



   ++i;
   $('#table').append(`
            <tr>
                
               <td data-lable=""><input readonly type="text" name="inputs[`+i+`][name]" value="`+deposit_name+` "  class="form-control"></td>

               <td data-lable="">
                      <select  name="inputs[`+i+`][size]" id="inputs[`+i+`][size]" non_complete_resoneValue="inputs[`+i+`][report_status]" class="form-control change-report-status">
                     <option   selected   value="L">L </option>
                       <option      value="M">M </option>
                     <option      value="S">S </option>
                     <option      value="XL">XL </option>
                     <option      value="XXL">XXL </option>
                     <option      value="XXXL">XXXL </option>
                     </select>
               </td>


               <td data-lable=""><input  type="text" id="inputs[`+i+`][amount]" name="inputs[`+i+`][amount]" value=" `+quantity+`" placeholder="amount" class="form-control"></td>
              
               <td data-lable=""><button type="button" class="btn btn-danger remove-table-row">Delete Deposit</button>
            </tr>

            `);

});

$(document).on('click','.remove-table-row', function(e){
   --i;
   if(i<1){
      $("#confirm_deposit").hide();
      $('#table').hide();
   }
   $(this).parents('tr').remove();
});


// $(document).on('change','.change-report-status', function(e){
//    var non_complete_resoneValue=$(this).attr("non_complete_resoneValue");
//    var val= $('#'+non_complete_resoneValue).val();
//    alert(val);
// });


$(document).on('click','.showImageButton', function(e){


//  var maneUrl=$("#showImageView").attr("value");
  var maneUrl=$(this).attr("value");




var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+maneUrl;

    $("#show_imageModal_Image").attr("src",srcV);


    $("#show_imageModal").modal("show");


});

</script>
@endsection

