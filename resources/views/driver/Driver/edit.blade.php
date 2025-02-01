@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
قائمة  المالية
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     الإدارة المالية</a>
@endsection
@section('contentheaderactive')
تحديث
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تحديث  ملاحظة مالية 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('financial.update',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
      
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          بيانات  السائق
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">


          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">بيانات السائق </a>
          </li>

         
        
        </ul>

        {{-- ======================================================================================================================= --}}
        {{-- ======================================================================================================================= --}}
        <div class="tab-content" id="custom-content-below-tabContent">
          <div class="tab-pane fade show active" id="custom-content-employee_sudan_data" role="tabpanel" aria-labelledby="sudan_data">
            <br>
            <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>    اسم السائق  كاملا</label>
                  <input readonly type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name',$data['driver_name']) }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4">
            <div class="form-group">
             <label> نوع التقديم  </label>
             <input readonly type="text" name="appointment_type" id="appointment_type" class="form-control" 
             @if(old('appointment_type',$data['appointment_type'])==1) value="قادم من البلد الام"
             @else value="من داخل قطر (داخلي)"
              @endif 
              >
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
    
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
         
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4">
              <div class="form-group">
                 <label>    هل  قام بتوريد مبلغ في البلد الام  </label>
                 <select   name="isPostPayInSudan" id="isPostPayInSudan" class="form-control">
                 <option @if(old('isPostPayInSudan',$data['isPostPayInSudan'])==0 and old('isPostPayInSudan')!="" ) selected @endif value="0">لا</option>
                 <option   @if(old('isPostPayInSudan',$data['isPostPayInSudan'])==1) selected @endif  value="1">نعم </option>
              </select>
                 @error('isPostPayInSudan')
                 <span class="text-danger">{{ $message }}</span> 
                 @enderror
              </div>
           </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4 relatedisPostPayInSudan" " @if($data['isPostPayInSudan']==0) style="display: none" @endif >
           <div class="form-group">
              <label>     قيمة المبلغ المورد في البلد الام  </label>
              <input  type="text" name="post_pay_amount" id="post_pay_amount" class="form-control" value="{{ old('post_pay_amount',$data['post_pay_amount']) }}" >
              @error('post_pay_amount')
              <span class="text-danger">{{ $message }}</span> 
              @enderror
           </div>
        </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
     
              <div class="col-md-4 relatedisPostPayInSudan" " @if($data['isPostPayInSudan']==0) style="display: none" @endif>
                 <div class="form-group" id="post_pay_pill_image_oldImage">
                    <label>     صورة ايصال بنكك   </label>
                    <div class="image">
                       @if ($data['post_pay_pill_image']!=null ||$data['post_pay_pill_image']!="")
  
                       @if (pathinfo($data['post_pay_pill_image'], PATHINFO_EXTENSION) == 'pdf')
                       <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['post_pay_pill_image'] }}"></iframe><br/>
                       @else
                       <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['post_pay_pill_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                       @endif
                       <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['post_pay_pill_image'] }}" style="width:50px;" value="post_pay_pill_image">عرض </button>
                       @endif
                       <button type="button" class="btn btn-sm btn-info" id="change_post_pay_pill_image2" style="width:100px;" value="post_pay_pill_image" >اختيار صورة</button>
                       <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_post_pay_pill_image">الغاء </button>
                   </div>
                    @error('post_pay_pill_image')
                    <span class="text-danger">{{ $message }}</span> 
                    @enderror
                 </div>
              </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
              

            
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4">
            <div class="form-group">
               <label>   الصورة الشخصية للسائق</label>
               @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                  <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">عرض </button>
                  @endif
            </div>
         </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}          
            
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

           <div class="col-md-4">
            <div class="form-group">
               <label>     رقم الهاتف القطري </label>
               <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data['driver_quater_tel']) }}" >
               @error('driver_quater_tel')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

           
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4">
              <div class="form-group">
                 <label>     اجمالي المديونية   </label>
                 <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data->GeneralLoan->total_loan) }}" >
                 @error('driver_quater_tel')
                 <span class="text-danger">{{ $message }}</span> 
                 @enderror
              </div>
           </div>
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4">
            <div class="form-group">
               <label>     عدد السلفيات   </label>
               <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{
                \App\Models\SpecialLoan::where('driver_id',$data->id)->count() 
                 
                }}" >
               @error('driver_quater_tel')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         <div class="col-md-4">
          <div class="form-group">
             <label>     اجمالي السلفيات   </label>
             <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ 
             \App\Models\SpecialLoan::where('driver_id',$data->id)->sum('loan_value')
              }}" >
             @error('driver_quater_tel')
             <span class="text-danger">{{ $message }}</span> 
             @enderror
          </div>
       </div>

       
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

         <div class="col-md-12 " >
          <div class="form-group">
             <label> ملاحظات الإدارة المالية علي الموظف </label>
             <textarea  type="text" name="driver_financial_notes" id="notes" class="form-control" >
                {{ old('driver_financial_notes',$data['driver_financial_notes']) }}

             </textarea>
             @error('driver_financial_notes')
             <span class="text-danger">{{ $message }}</span> 
             @enderror
          </div>
       </div>




         </div>

         </div>

          {{-- ======================================================================================================================= --}}
          {{-- ======================================================================================================================= --}}
        
                   
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            <div class="col-md-12">
              <div class="form-group text-center"> 
                 <label class="text-danger" @if ($data['isSigningInitialContract']!=1
                 || $data->isGivePassPort!=1
                 || $data->isSigningMainContract!=1
                 || $data->isSigningFullFinancialDebt!=1
                 || $data->isSigningPenaltyClause!=1
                 ) @else style="display: none"  @endif>       غير مسموح بالبداء بأي اجراء حتي يتم توقيع جميع العقود والمديونيات   </label><br/>
                 <button class="btn btn-sm btn-success" type="submit" name="submit"
                 @if ($data['isSigningInitialContract']!=1
                 || $data->isGivePassPort!=1
                 || $data->isSigningMainContract!=1
                 || $data->isSigningFullFinancialDebt!=1
                 || $data->isSigningPenaltyClause!=1
                 ) disabled  @endif>تحديث بيانات السائق </button>
                 <a href="{{ route('financial.index') }}" class="btn btn-danger btn-sm">الغاء</a>
              </div>
           </div>
         </form>
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
   url:'{{ route('financial.get_governorates') }}',
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
   url:'{{ route('financial.get_centers') }}',
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
</script>
@endsection