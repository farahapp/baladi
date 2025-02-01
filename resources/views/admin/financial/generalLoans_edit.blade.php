@extends('layouts.admin')
@section('title')
بيانات المديونية
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
قائمة  الإدارة المالية
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     المديونية</a>
@endsection
@section('contentheaderactive')
تحديث
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تحديث  المديونية 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('financial.generalLoans_update',$generalloan['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
      
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          بيانات المديونية  
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">


          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">المبلغ المدفوع</a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link" id="quater_data" data-toggle="pill" href="#custom-content-employee_quater_data" role="tab" aria-controls="custom-content-employee_quater_data" aria-selected="false">المبلغ المتبقي</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="quater_data2" data-toggle="pill" href="#custom-content-employee_quater_data2" role="tab" aria-controls="custom-content-employee_quater_data2" aria-selected="false">إجمالي المديونية</a>
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
                 
                 <div class="col-md-4">
                  <div class="form-group">
                    <label>   هل لدية رخصة في البلد الام    	</label>
                    <input readonly type="text" name="does_has_sudanese_Driving_License" id="does_has_sudanese_Driving_License" class="form-control" 
                   @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==1) value="لديه رخصة"
                   @else value="ليس لديه رخصة"
                    @endif 
                    >
                     @error('does_has_sudanese_Driving_License')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
            
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
   
   
             {{-- ======================================================================================================================= --}}
             {{-- ======================================================================================================================= --}}
             

       
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
   
         
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         
                <div class="col-md-4">
                  <div class="form-group">
                     <label>       خدمات   </label>
                     <input type="text" name="services_fees_paid" id="services_fees_paid" class="form-control" value="{{ old('services_fees_paid',$generalloan['services_fees_paid']) }}"
                      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
                     @error('services_fees_paid')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
             <div class="form-group">
                <label>       طباعة التاشيرة   </label>
                <input  type="text" name="visa_print_paid" id="visa_print_paid" class="form-control" value="{{ old('visa_print_paid',$generalloan['visa_print_paid']) }}" 
                @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
                @error('visa_print_paid')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
             </div>
          </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       إيجار ومعيشة الشهر الأول   </label>
            <input  type="text" name="first_month_rent_and_food_paid" id="first_month_rent_and_food_paid" class="form-control" value="{{ old('first_month_rent_and_food_paid',$generalloan['first_month_rent_and_food_paid']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('first_month_rent_and_food_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عمولة   </label>
            <input  type="text" name="commision_paid" id="commision_paid" class="form-control" value="{{ old('commision_paid',$generalloan['commision_paid']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('commision_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تجهيز السكن    </label>
            <input  type="text" name="accomodation_preparation_paid" id="accomodation_preparation_paid" class="form-control" value="{{ old('accomodation_preparation_paid',$generalloan['accomodation_preparation_paid']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('accomodation_preparation_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الزي الرسمي   </label>
            <input  type="text" name="uniform_paid" id="uniform_paid" class="form-control" value="{{ old('uniform_paid',$generalloan['uniform_paid']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('uniform_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الشريحة الصورة   </label>
            <input  type="text" name="sim_and_photo_paid" id="sim_and_photo_paid" class="form-control" value="{{ old('sim_and_photo_paid',$generalloan['sim_and_photo_paid']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('sim_and_photo_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تنقل   </label>
            <input  type="text" name="transportaion_paid" id="transportaion_paid" class="form-control" value="{{ old('transportaion_paid',$generalloan['transportaion_paid']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('transportaion_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الفحص الطبي   </label>
            <input  type="text" name="medical_paid" id="medical_paid" class="form-control" value="{{ old('medical_paid',$generalloan['medical_paid']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('medical_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عقد الكتروني   </label>
            <input  type="text" name="e_contract_paid" id="e_contract_paid" class="form-control" value="{{ old('e_contract_paid',$generalloan['e_contract_paid']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('e_contract_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       طباعة بطاقة الاقامة   </label>
            <input  type="text" name="qid_issuing_paid" id="qid_issuing_paid" class="form-control" value="{{ old('qid_issuing_paid',$generalloan['qid_issuing_paid']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('qid_issuing_paid')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       الكرت الصحي   </label>
        <input  type="text" name="health_card_paid" id="health_card_paid" class="form-control" value="{{ old('health_card_paid',$generalloan['health_card_paid']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('health_card_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
      @if ($data['does_has_sudanese_Driving_License']==1)
      <label>       تسجيل المدرسة (نصف دورة)   </label>
      @else
      <label>       تسجيل المدرسة (دورة كاملة)   </label>
      @endif
        <input  type="text" name="school_registration_paid" id="school_registration_paid" class="form-control" value="{{ old('school_registration_paid',$generalloan['school_registration_paid']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('school_registration_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       طباعة الرخصة   </label>
        <input  type="text" name="liesence_print_paid" id="liesence_print_paid" class="form-control" value="{{ old('liesence_print_paid',$generalloan['liesence_print_paid']) }}"
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
        @error('liesence_print_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       اعاشة وايجار الشهر الثاني   </label>
        <input  type="text" name="second_month_rent_and_food_paid" id="second_month_rent_and_food_paid" class="form-control" value="{{ old('second_month_rent_and_food_paid',$generalloan['second_month_rent_and_food_paid']) }}"
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif  >
        @error('second_month_rent_and_food_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
       <label>       اعاشة وايجار الشهر الثالث   </label>
       <input  type="text" name="third_month_rent_and_food_paid" id="third_month_rent_and_food_paid" class="form-control" value="{{ old('third_month_rent_and_food_paid',$generalloan['third_month_rent_and_food_paid']) }}"
       @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
        @error('third_month_rent_and_food_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       تدريب الشهر الأول والثاني   </label>
        <input  type="text" name="training_1st_and_2nd_month_paid" id="training_1st_and_2nd_month_paid" class="form-control" value="{{ old('training_1st_and_2nd_month_paid',$generalloan['training_1st_and_2nd_month_paid']) }}"
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
        @error('training_1st_and_2nd_month_paid')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
      <div class="form-group">
         <label>       الهاتف   </label>
         <input  type="text" name="phone_loan_paid" id="phone_loan_paid" class="form-control" value="{{ old('phone_loan_paid',$generalloan['phone_loan_paid']) }}"
         @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
         @error('phone_loan_paid')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
    </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-12">
      <div class="form-group">
         <label>       إجمالي المبلغ المدفوع   </label>
         <input readonly type="text" name="total_loan_paid" id="total_loan_paid" class="form-control" value="{{ old('total_loan_paid',$generalloan['total_loan_paid']) }}"
         @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
         @error('total_loan_paid')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
    </div>
     
         
       
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


          


         </div>

         </div>

          {{-- ======================================================================================================================= --}}
          {{-- ======================================================================================================================= --}}


          <div class="tab-pane fade" id="custom-content-employee_quater_data" role="tabpanel" aria-labelledby="quater_data">
            <br>
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group">
                     <label>       خدمات   </label>
                     <input readonly type="text" name="services_fees_remaining" id="services_fees_remaining" class="form-control" value="{{ old('services_fees_remaining',$generalloan['services_fees_remaining']) }}" >
                     @error('services_fees_remaining')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
             <div class="form-group">
                <label>       طباعة التاشيرة   </label>
                <input readonly type="text" name="visa_print_remaining" id="visa_print_remaining" class="form-control" value="{{ old('visa_print_remaining',$generalloan['visa_print_remaining']) }}" >
                @error('visa_print_remaining')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
             </div>
          </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       إيجار ومعيشة الشهر الأول   </label>
            <input readonly type="text" name="first_month_rent_and_food_remaining" id="first_month_rent_and_food_remaining" class="form-control" value="{{ old('first_month_rent_and_food_remaining',$generalloan['first_month_rent_and_food_remaining']) }}" >
            @error('first_month_rent_and_food_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عمولة   </label>
            <input readonly type="text" name="commision_remaining" id="commision_remaining" class="form-control" value="{{ old('commision_remaining',$generalloan['commision_remaining']) }}" >
            @error('commision_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تجهيز السكن    </label>
            <input readonly type="text" name="accomodation_preparation_remaining" id="accomodation_preparation_remaining" class="form-control" value="{{ old('accomodation_preparation_remaining',$generalloan['accomodation_preparation_remaining']) }}" >
            @error('accomodation_preparation_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الزي الرسمي   </label>
            <input readonly type="text" name="uniform_remaining" id="uniform_remaining" class="form-control" value="{{ old('uniform_remaining',$generalloan['uniform_remaining']) }}" >
            @error('uniform_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الشريحة الصورة   </label>
            <input readonly type="text" name="sim_and_photo_remaining" id="sim_and_photo_remaining" class="form-control" value="{{ old('sim_and_photo_remaining',$generalloan['sim_and_photo_remaining']) }}" >
            @error('sim_and_photo_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تنقل   </label>
            <input readonly type="text" name="transportaion_remaining" id="transportaion_remaining" class="form-control" value="{{ old('transportaion_remaining',$generalloan['transportaion_remaining']) }}" >
            @error('transportaion_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الفحص الطبي   </label>
            <input readonly type="text" name="medical_remaining" id="medical_remaining" class="form-control" value="{{ old('medical_remaining',$generalloan['medical_remaining']) }}" >
            @error('medical_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عقد الكتروني   </label>
            <input readonly type="text" name="e_contract_remaining" id="e_contract_remaining" class="form-control" value="{{ old('e_contract_remaining',$generalloan['e_contract_remaining']) }}" >
            @error('e_contract_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       طباعة بطاقة الاقامة   </label>
            <input readonly type="text" name="qid_issuing_remaining" id="qid_issuing_remaining" class="form-control" value="{{ old('qid_issuing_remaining',$generalloan['qid_issuing_remaining']) }}" >
            @error('qid_issuing_remaining')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       الكرت الصحي   </label>
        <input readonly type="text" name="health_card_remaining" id="health_card_remaining" class="form-control" value="{{ old('health_card_remaining',$generalloan['health_card_remaining']) }}" >
        @error('health_card_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       تسجيل المدرسة   </label>
        <input readonly type="text" name="school_registration_remaining" id="school_registration_remaining" class="form-control" value="{{ old('school_registration_remaining',$generalloan['school_registration_remaining']) }}" >
        @error('school_registration_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       طباعة الرخصة   </label>
        <input readonly type="text" name="liesence_print_remaining" id="liesence_print_remaining" class="form-control" value="{{ old('liesence_print_remaining',$generalloan['liesence_print_remaining']) }}" >
        @error('liesence_print_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       اعاشة وايجار الشهر الثاني   </label>
        <input readonly type="text" name="second_month_rent_and_food_remaining" id="second_month_rent_and_food_remaining" class="form-control" value="{{ old('second_month_rent_and_food_remaining',$generalloan['second_month_rent_and_food_remaining']) }}" >
        @error('second_month_rent_and_food_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
       <label>       اعاشة وايجار الشهر الثالث   </label>
       <input readonly type="text" name="third_month_rent_and_food_remaining" id="third_month_rent_and_food_remaining" class="form-control" value="{{ old('third_month_rent_and_food_remaining',$generalloan['third_month_rent_and_food_remaining']) }}" >
        @error('third_month_rent_and_food_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       تدريب الشهر الأول والثاني   </label>
        <input readonly type="text" name="training_1st_and_2nd_month_remaining" id="training_1st_and_2nd_month_remaining" class="form-control" value="{{ old('training_1st_and_2nd_month_remaining',$generalloan['training_1st_and_2nd_month_remaining']) }}" >
        @error('training_1st_and_2nd_month_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       الهاتف   </label>
        <input readonly type="text" name="phone_loan_remaining" id="phone_loan_remaining" class="form-control" value="{{ old('phone_loan_remaining',$generalloan['phone_loan_remaining']) }}" >
        @error('phone_loan_remaining')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-12">
      <div class="form-group">
         <label>       إجمالي المبلغ المتبقي   </label>
         <input readonly type="text" name="total_loan_remaining" id="total_loan_remaining" class="form-control" value="{{ old('total_loan_remaining',$generalloan['total_loan_remaining']) }}" >
         @error('total_loan_remaining')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
    </div>

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       
      
         </div>
         </div>

           {{-- ======================================================================================================================= --}}
           {{-- ======================================================================================================================= --}}
           <div class="tab-pane fade" id="custom-content-employee_quater_data2" role="tabpanel" aria-labelledby="quater_data2">
            <br>
            <div class="row">

                          <div class="col-md-4">
                  <div class="form-group">
                     <label>       خدمات   </label>
                     <input  type="text" name="services_fees" id="services_fees" class="form-control" value="{{ old('services_fees',$generalloan['services_fees']) }}" 
                     @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
                     @error('services_fees')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
             <div class="form-group">
                <label>       طباعة التاشيرة   </label>
                <input  type="text" name="visa_print" id="visa_print" class="form-control" value="{{ old('visa_print',$generalloan['visa_print']) }}"
                @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
                @error('visa_print')
                <span class="text-danger">{{ $message }}</span> 
                @enderror
             </div>
          </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       إيجار ومعيشة الشهر الأول   </label>
            <input  type="text" name="first_month_rent_and_food" id="first_month_rent_and_food" class="form-control" value="{{ old('first_month_rent_and_food',$generalloan['first_month_rent_and_food']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('first_month_rent_and_food')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عمولة   </label>
            <input  type="text" name="commision" id="commision" class="form-control" value="{{ old('commision',$generalloan['commision']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('commision')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تجهيز السكن    </label>
            <input  type="text" name="accomodation_preparation" id="accomodation_preparation" class="form-control" value="{{ old('accomodation_preparation',$generalloan['accomodation_preparation']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('accomodation_preparation')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الزي الرسمي   </label>
            <input  type="text" name="uniform" id="uniform" class="form-control" value="{{ old('uniform',$generalloan['uniform']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('uniform')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الشريحة الصورة   </label>
            <input  type="text" name="sim_and_photo" id="sim_and_photo" class="form-control" value="{{ old('sim_and_photo',$generalloan['sim_and_photo']) }}"
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('sim_and_photo')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تنقل   </label>
            <input  type="text" name="transportaion" id="transportaion" class="form-control" value="{{ old('transportaion',$generalloan['transportaion']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('transportaion')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       الفحص الطبي   </label>
            <input  type="text" name="medical" id="medical" class="form-control" value="{{ old('medical',$generalloan['medical']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('medical')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       عقد الكتروني   </label>
            <input  type="text" name="e_contract" id="e_contract" class="form-control" value="{{ old('e_contract',$generalloan['e_contract']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
            @error('e_contract')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       طباعة بطاقة الاقامة   </label>
            <input  type="text" name="qid_issuing" id="qid_issuing" class="form-control" value="{{ old('qid_issuing',$generalloan['qid_issuing']) }}" 
            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
            @error('qid_issuing')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       الكرت الصحي   </label>
        <input  type="text" name="health_card" id="health_card" class="form-control" value="{{ old('health_card',$generalloan['health_card']) }}"
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
        @error('health_card')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       تسجيل المدرسة   </label>
        <input  type="text" name="school_registration" id="school_registration" class="form-control" value="{{ old('school_registration',$generalloan['school_registration']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('school_registration')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       طباعة الرخصة   </label>
        <input  type="text" name="liesence_print" id="liesence_print" class="form-control" value="{{ old('liesence_print',$generalloan['liesence_print']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('liesence_print')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       اعاشة وايجار الشهر الثاني   </label>
        <input  type="text" name="second_month_rent_and_food" id="second_month_rent_and_food" class="form-control" value="{{ old('second_month_rent_and_food',$generalloan['second_month_rent_and_food']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('second_month_rent_and_food')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
       <label>       اعاشة وايجار الشهر الثالث   </label>
       <input  type="text" name="third_month_rent_and_food" id="third_month_rent_and_food" class="form-control" value="{{ old('third_month_rent_and_food',$generalloan['third_month_rent_and_food']) }}"
       @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif >
        @error('third_month_rent_and_food')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
     <div class="form-group">
        <label>       تدريب الشهر الأول والثاني   </label>
        <input  type="text" name="training_1st_and_2nd_month" id="training_1st_and_2nd_month" class="form-control" value="{{ old('training_1st_and_2nd_month',$generalloan['training_1st_and_2nd_month']) }}" 
        @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
        @error('training_1st_and_2nd_month')
        <span class="text-danger">{{ $message }}</span> 
        @enderror
     </div>
   </div>
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4">
      <div class="form-group">
         <label>       الهاتف   </label>
         <input  type="text" name="phone_loan" id="phone_loan" class="form-control" value="{{ old('phone_loan',$generalloan['phone_loan']) }}" 
         @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(34)==true) @else readonly @endif>
         @error('phone_loan')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
    </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
    <div class="col-md-12">
      <div class="form-group">
         <label>       إجمالي  المديونية   </label>
         <input readonly  type="text" name="total_loan" id="total_loan" class="form-control" value="{{ old('total_loan',$generalloan['total_loan']) }}" >
         @error('total_loan')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
    </div>

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       
      
         </div>
         </div>




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
         <a href="{{ route('HumanResource.index') }}" class="btn btn-danger btn-sm">الغاء</a>
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