@extends('layouts.admin')
@section('title')
Drivers
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
Drivers
@endsection
@section('contentheaderactivelink')
<a href="{{ route('HumanResource.index') }}"> Drivers</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Add new driver
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('HumanResource.store') }}" method="post" enctype="multipart/form-data">
            @csrf
      
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          Driver Required Data
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">


          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">New Driver Data</a>
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
                  <label>    Name   </label>
                  <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name') }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group">
                     <label>      Arabic Name </label>
                     <input  type="text" name="driver_english_name" id="driver_english_name" class="form-control" value="{{ old('driver_english_name') }}" >
                     @error('driver_english_name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
              <div class="col-md-4">
               <div class="form-group">
                  <label> Operating company </label>
                  <select name="branches" id="branches  " class="form-control select2 ">
                     @if (@isset($other['branches']) && !@empty($other['branches']))
                     @foreach ($other['branches'] as $info )
                     <option @if(old('branches')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('branches')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group">
                     <label>      Baladi ID </label>
                     <input  type="text" name="baladi_id" id="baladi_id" class="form-control" value="{{ old('baladi_id') }}" >
                     @error('baladi_id')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
              <div class="col-md-4">
               <div class="form-group">
                  <label>      Birth Date</label>
                  <input type="date" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date') }}" >
                  @error('brith_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label> Nationality</label>
            <select name="nationalities" id="nationalities  " class="form-control select2 ">
               @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
               @foreach ($other['nationalities'] as $info )
               <option @if(old('nationalities')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
               @endforeach
               @endif
            </select>
            @error('nationalities')
            <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div> 

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


{{--       
      <div class="col-md-4">
         <div class="form-group">
            <label>  Type of work</label>
            <select  name="job_type" id="job_type" class="form-control">
            <option   @if(old('job_type')==1) selected @endif  value="1">ليموزين </option>
            <option @if(old('job_type')==2 ) selected @endif value="2">ديلفري  </option>
            <option @if(old('job_type')==3 ) selected @endif value="3">إداري  </option>
            <option @if(old('job_type')==4 ) selected @endif value="4">إعارة  </option>
            </select>
            @error('job_type')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}

   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

{{-- 
      
      
   <div class="col-md-4 related_job_type" style="display: none">
         <div class="form-group">
            <label>  Delivery type</label>
            <select  name="delevery_type" id="delevery_type" class="form-control">
            <option   @if(old('delevery_type')==1) selected @endif  value="1">Car driver</option>
            <option @if(old('delevery_type')==2 ) selected @endif value="2">bike rider</option>
            </select>
            @error('delevery_type')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}

      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label> Gender</label>
            <select  name="driver_gender" id="driver_gender" class="form-control">
            <option   @if(old('driver_gender')==1) selected @endif  value="1">male</option>
            <option @if(old('driver_gender')==2 ) selected @endif value="2">female</option>
            </select>
            @error('driver_gender')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
   <div class="form-group">
      <label> marital status </label>
      <select  name="marital_status" id="marital_status" class="form-control">
      <option   @if(old('marital_status')==0) selected @endif  value="0">Single</option>
      <option   @if(old('marital_status')==1) selected @endif  value="1">Married</option>
   </select>
      @error('marital_status')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
<div class="col-md-4 related_marital_status " style="display: none" >
<div class="form-group">
      <label>  Children Number</label>
      <input type="text" name="sons_number" id="sons_number" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('sons_number') }}" >
      @error('sons_number')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                      <div class="col-md-4 " >
               <div class="form-group">
                  <label>   Passport number  </label>
                  <input type="text" name="driver_pasport_no" id="driver_pasport_no" class="form-control" value="{{ old('driver_pasport_no') }}" >
                  @error('driver_pasport_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>  Passport Expiry Date	</label>
                  <input type="date" name="driver_pasport_exp" id="driver_pasport_exp" class="form-control" value="{{ old('driver_pasport_exp') }}" >
                  @error('driver_pasport_exp')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4">
               <div class="form-group">
                  <label>    Passport photo  </label>
                  <input type="file" name="driver_pasport_image" id="driver_pasport_image" class="form-control" value="{{ old('driver_pasport_image') }}" >
                  @error('driver_pasport_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                        
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}      
            <div class="col-md-4">
               <div class="form-group">
                  <label>  Educational qualification</label>
                  <select name="Qualifications_id" id="Qualifications_id  " class="form-control select2 ">
                     <option value="">Select qualification</option>
                     @if (@isset($other['qualifications']) && !@empty($other['qualifications']))
                     @foreach ($other['qualifications'] as $info )
                     <option @if(old('Qualifications_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('Qualifications_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
                       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4">
               <div class="form-group">
                  <label>     Phone number in home country</label>
                  <input type="text" name="driver_sudan_tel" id="driver_sudan_tel" class="form-control" value="{{ old('driver_sudan_tel') }}" >
                  @error('driver_sudan_tel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-12">
               <div class="form-group">
                  <label>   Driver's residence address in the home country </label>
                  <input type="text" name="sudan_driver_Basic_stay_address" id="sudan_driver_Basic_stay_address" class="form-control" value="{{ old('sudan_driver_Basic_stay_address') }}" >
                  @error('sudan_driver_Basic_stay_address')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(30)==true)

          <div class="col-md-4">
            <div class="form-group">
               <label> Submission type  </label>
               <select  name="appointment_type" id="appointment_type" class="form-control">
               <option   @if(old('appointment_type')==1) selected @endif  value="1">Coming from home country</option>
               <option   @if(old('appointment_type')==2) selected @endif  value="2">From within Qatar (internal)</option>
            </select>
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         @elseif (check_permission_sub_menue_actions(28)==true ||check_permission_sub_menue_actions(29)==true)
         <div class="col-md-4">
            <div class="form-group">
             <label> Submission type  </label>
             <input readonly type="text" name="appointment_type" id="appointment_type" class="form-control" 
             @if(old('appointment_type')==1) value="Coming from home country"
             @else value="From within Qatar (internal)"
              @endif 
              >
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         @endif

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   
               
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
               <label>The recruiting company</label>
               <input type="text" name="employer" id="employer" class="form-control" value="{{ old('employer') }}" >
               @error('employer')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
             </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
         <div class="form-group">
      <label>      No Objection Image       </label>
      <input type="file" name="no_objection_image" id="no_objection_image" class="form-control" value="{{ old('no_objection_image') }}" >
      @error('no_objection_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>   
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
     
         <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
         <label>   Entry Qatar Date</label>
         <input  type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date') }}" >
         @error('arrive_qater_date')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>


            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label>      License Printing Date    </label>
                  <input  type="date" name="printing_licence_date" id="printing_licence_date" class="form-control" value="{{ old('printing_licence_date') }}" placeholder="لون المركبة"  >
                  @error('printing_licence_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

         

        
      <div class="col-md-4">
         <div class="form-group">
            <label>     Qatari License Photo    </label>
            <input type="file" name="qatary_driving_license_Image_image" id="qatary_driving_license_Image_image" class="form-control" value="{{ old('qatary_driving_license_Image_image') }}" >
            @error('qatary_driving_license_Image_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
     
       
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4">
            <div class="form-group">
               <label>   Driver's photo</label>
               <input type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo') }}" >
               @error('driver_photo')
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

           {{-- ======================================================================================================================= --}}
           {{-- ======================================================================================================================= --}}
           {{-- ======================================================================================================================= --}}
          
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">Add driver </button>
                  <a href="{{ route('HumanResource.index') }}" class="btn btn-danger btn-sm">Back</a>
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

            <img style=" width:700px;height: 500px;" id="show_imageModal_Image" class="custom_img" src="" alt="الصورة الشخصية للسائق" ><br/>

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
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   $(document).on('change','#country_id',function(e){
      get_governorates();
      });
   function get_governorates(){
   var country_id=$("#country_id").val();
   jQuery.ajax({
   url:'{{ route('HumanResource.get_governorates') }}',
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
   url:'{{ route('HumanResource.get_centers') }}',
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

   $(document).on('change','#appointment_type',function(e){
 if($(this).val()!=1 ){
$(".related_appointment_type").hide();
$(".related_appointment_type_second_value").show();
 }else{
   $(".related_appointment_type").show();
   $(".related_appointment_type_second_value").hide();

 }

   });


   $(document).on('change','#job_type',function(e){
 if($(this).val()!=2 ){
$(".related_job_type").hide();
 }else{
   $(".related_job_type").show();

 }

   });

</script>
@endsection