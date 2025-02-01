@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
   img {
     border-radius: 8px;
   }
   </style>
@endsection

@section('contentheader')
قائمة  السائقين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Employees.index') }}">     الموظفين</a>
@endsection
@section('contentheaderactive')
تحديث
@endsection
@section('content')
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تحديث  سائق جديد
         </h3>
      </div>
      <div class="card-body">
        
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          البيانات المطلوبة للسائق
        </h3>
      </div>
      
      

        {{-- ======================================================================================================================= --}}
        {{-- ======================================================================================================================= --}}
        {{-- <div class="tab-content" id="custom-content-below-tabContent">
          <div class="tab-pane fade show active" id="custom-content-employee_sudan_data" role="tabpanel" aria-labelledby="sudan_data">
            <br> --}}


            <div class="col-md-12" style="text-align: center">
               <div class="form-group">
                  @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                     <img class="custom_img"  alt="Avatar"  id="showImageView"  src="{{ secure_asset('assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">عرض الصورة</button>
                     @endif
               </div>
               <label>{{ old('driver_name',$data['driver_name']) }}</label>
            </div>   


          


             <br/> 
          <h3 align="center">View Details</h3>
          <br/>
          <table class="table table-striped table-bordered"id="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Size</th>
              </tr>
            </thead>
            <tbody id="table_data">
              {{-- @foreach ($deposits as $row)
              <tr>
                <td>{{$row["name"]}}</td>
                <td>{{$row["size"]}}</td>
              </tr>
              @endforeach --}}
            </tbody>
          </table>

          <br/> 

            <div class="row">
            @foreach ($deposits as $raw)
            <form  method="post">
               {{-- <form  method="post"> --}}
                  @csrf
                  <div style="border:1px solid #333;
                  background-color:#f1f1f1;
                  border-radius:5px;padding:16px;"
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

          
          
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
          
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            
            
                       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                

        


         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        
                     {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}          
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


         

         {{-- </div>

         </div> --}}

                 {{-- ======================================================================================================================= --}}

         </div>

           {{-- ======================================================================================================================= --}}
          
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            
       
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
 {{-- ======================================================================================================================= --}}
@endsection


@section("script")
<script src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });



   $(document).on('click','.showImageButton', function(e){


//  var maneUrl=$("#showImageView").attr("value");
  var maneUrl=$(this).attr("value");




var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+maneUrl;

    $("#show_imageModal_Image").attr("src",srcV);


    $("#show_imageModal").modal("show");


});


   $(document).on('change','#country_id',function(e){
      get_governorates();
      });
   function get_governorates(){
   var country_id=$("#country_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_governorates') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',country_id:country_id},
   success: function(data){
   $("#governorates_Div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}

$(document).on('change','#governorates_id',function(e){
      get_centers();
      });
   function get_centers(){
   var governorates_id=$("#governorates_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_centers') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',governorates_id:governorates_id},
   success: function(data){
   $("#centers_div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}

      $(document).on('change','#does_has_sudanese_Driving_License',function(e){
 if($(this).val()==1  ){
$(".related_does_has_sudanese_Driving_License").show();
 }else{
   $(".related_does_has_sudanese_Driving_License").hide();
 }
   });
   $(document).on('change','#has_Relatives',function(e){
 if($(this).val()==1  ){
$(".Related_Relatives_detailsDiv").show();
 }else{
   $(".Related_Relatives_detailsDiv").hide();
 }
   });

   $(document).on('change','#marital_status',function(e){
 if($(this).val()==1  ){
$(".related_marital_status").show();
 }else{
   $(".related_marital_status").hide();
 }
   });



   
   
   $(document).on('change','#MotivationType',function(e){
 if($(this).val()!=2 ){
$("#MotivationDIV").hide();
 }else{
   $("#MotivationDIV").show();

 }
 
   });

   $(document).on('change','#isVisaPrinted',function(e){
 if($(this).val()!=1 ){
$(".relatedisVisaPrinted").hide();
 }else{
   $(".relatedisVisaPrinted").show();

 }

   });

   $(document).on('change','#isPostPayInSudan',function(e){
 if($(this).val()!=1 ){
$(".relatedisPostPayInSudan").hide();
 }else{
   $(".relatedisPostPayInSudan").show();

 }
   });

   

   $(document).on('change','#isSigningInitialContract',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningInitialContract").hide();
 }else{
   $(".relatedisSigningInitialContract").show();

 }

   });

   $(document).on('change','#isSigningMainContract',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningMainContract").hide();
 }else{
   $(".relatedisSigningMainContract").show();

 }

   });


   
   

   $(document).on('change','#isGivePassPort',function(e){
 if($(this).val()!=1 ){
$(".relatedisGivePassPort").hide();
 }else{
   $(".relatedisGivePassPort").show();

 }

   });

   
   $(document).on('change','#isSigningFullFinancialDebt',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningFullFinancialDebt").hide();
 }else{
   $(".relatedisSigningFullFinancialDebt").show();

 }

   });

   $(document).on('change','#isSigningPenaltyClause',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningPenaltyClause").hide();
 }else{
   $(".relatedisSigningPenaltyClause").show();

 }

   });


   $(document).on('change','#isSigningPenaltyClauseCheck',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningPenaltyClauseCheck").hide();
 }else{
   $(".relatedisSigningPenaltyClauseCheck").show();

 }

   });


   $(document).on('change','#isSigningFullFinancialDebtCheck',function(e){
 if($(this).val()!=1 ){
$(".relatedisSigningFullFinancialDebtCheck").hide();
 }else{
   $(".relatedisSigningFullFinancialDebtCheck").show();

 }

   });


   
   

   $(document).on('change','#driver_residency_process_status',function(e){
 if($(this).val()!=1 ){
$(".related_driver_residency_process_status").hide();
 }else{
   $(".related_driver_residency_process_status").show();

 }

   });


   $(document).on('change','#driver_bank_process',function(e){
 if($(this).val()!=1 ){
$(".related_driver_bank_process").hide();
 }else{
   $(".related_driver_bank_process").show();

 }

   });

   
   $(document).on('change','#driving_school_status',function(e){
 if($(this).val()!=1 ){
$(".related_driving_school_status").hide();
 }else{
   $(".related_driving_school_status").show();

 }

   });

   
   

   $(document).on('change','#ismedicalinsurance',function(e){
 if($(this).val()!=1 ){
$(".relatedismedicalinsurance").hide();
 }else{
   $(".relatedismedicalinsurance").show();

 }

   });


   
   var i=0;
   $(document).on('click','#add', function(e){
   ++i;
   $('#table').append(`
            <tr>

            
               <td data-lable=""><input type="text" id="inputs[`+i+`][non_complete_resone]" name="inputs[`+i+`][non_complete_resone]" value="{{ old('inputs[`+i+`][non_complete_resone]') }}" placeholder=" أسباب عدم  الإكتمال" class="form-control"></td>
              
               <td data-lable=""><button type="button" class="btn btn-danger remove-table-row">حذف المهمة</button>
            </tr>

            `);

});

   
</script>
@endsection