@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
قائمة  السائقين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('HumanResource.index') }}">     السائقين</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة  سائق جديد
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
          البيانات المطلوبة للسائق
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">


          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">بيانات سائق جديد</a>
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
                  <label>    الإسم   </label>
                  <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name') }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group">
                     <label>      Name </label>
                     <input  type="text" name="driver_english_name" id="driver_english_name" class="form-control" value="{{ old('driver_english_name') }}" >
                     @error('driver_english_name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
              <div class="col-md-4">
               <div class="form-group">
                  <label>        تاريخ الميلاد</label>
                  <input type="date" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date') }}" >
                  @error('brith_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label> الجنسية</label>
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


      
      <div class="col-md-4">
         <div class="form-group">
            <label>  نوع العمل</label>
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
      </div>

   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


      
      
   <div class="col-md-4 related_job_type" style="display: none">
         <div class="form-group">
            <label>  نوع الديلفري</label>
            <select  name="delevery_type" id="delevery_type" class="form-control">
            <option   @if(old('delevery_type')==1) selected @endif  value="1">سائق سيارة</option>
            <option @if(old('delevery_type')==2 ) selected @endif value="2">سائق دراجة نارية</option>
            </select>
            @error('delevery_type')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label> الجنس</label>
            <select  name="driver_gender" id="driver_gender" class="form-control">
            <option   @if(old('driver_gender')==1) selected @endif  value="1">ذكر</option>
            <option @if(old('driver_gender')==2 ) selected @endif value="2">انثي</option>
            </select>
            @error('driver_gender')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
   <div class="form-group">
      <label> الحالة الاجتماعية </label>
      <select  name="marital_status" id="marital_status" class="form-control">
      <option   @if(old('marital_status')==0) selected @endif  value="0">عاذب</option>
      <option   @if(old('marital_status')==1) selected @endif  value="1">متزوج</option>
   </select>
      @error('marital_status')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
<div class="col-md-4 related_marital_status " style="display: none" >
<div class="form-group">
      <label> عدد الابناء</label>
      <input type="text" name="sons_number" id="sons_number" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('sons_number') }}" >
      @error('sons_number')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

           
         <div class="col-md-4">
            <div class="form-group">
               <label> فرع الشركة</label>
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
                      <div class="col-md-4 " >
               <div class="form-group">
                  <label>   رقم جواز السفر  	</label>
                  <input type="text" name="driver_pasport_no" id="driver_pasport_no" class="form-control" value="{{ old('driver_pasport_no') }}" >
                  @error('driver_pasport_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>  تاريخ انتهاء جواز السفر	</label>
                  <input type="date" name="driver_pasport_exp" id="driver_pasport_exp" class="form-control" value="{{ old('driver_pasport_exp') }}" >
                  @error('driver_pasport_exp')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4">
               <div class="form-group">
                  <label>     صورة جواز السفر  </label>
                  <input type="file" name="driver_pasport_image" id="driver_pasport_image" class="form-control" value="{{ old('driver_pasport_image') }}" >
                  @error('driver_pasport_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- <div class="col-md-4" " >
               <div class="form-group" id="driver_pasport_image_oldImage">
                  <label>     صورة جواز السفر  </label>
                  <div class="image">
                     @if ($data['driver_pasport_image']!=null ||$data['driver_pasport_image']!="")
                     <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_pasport_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_pasport_image'] }}" style="width:50px;" value="driver_pasport_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_driver_pasport_image" style="width:100px;" value="driver_pasport_image" >اختيار صورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_driver_pasport_image">الغاء </button>
                 </div>
                  @error('driver_pasport_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
                        
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}      
            <div class="col-md-4">
               <div class="form-group">
                  <label>  المؤهل الدراسي</label>
                  <select name="Qualifications_id" id="Qualifications_id  " class="form-control select2 ">
                     <option value="">اختر المؤهل</option>
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
                  <label>     رقم الهاتف في البلد الام</label>
                  <input type="text" name="driver_sudan_tel" id="driver_sudan_tel" class="form-control" value="{{ old('driver_sudan_tel') }}" >
                  @error('driver_sudan_tel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-12">
               <div class="form-group">
                  <label>    عنوان اقامة السائق في البلد الام 	</label>
                  <input type="text" name="sudan_driver_Basic_stay_address" id="sudan_driver_Basic_stay_address" class="form-control" value="{{ old('sudan_driver_Basic_stay_address') }}" >
                  @error('sudan_driver_Basic_stay_address')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4">
            <div class="form-group">
               <label>    هل  قام بتوريد مبلغ في البلد الام  </label>
               <select  name="isPostPayInSudan" id="isPostPayInSudan" class="form-control">
               <option @if(old('isPostPayInSudan')==0 and old('isPostPayInSudan')!="" ) selected @endif value="0">لا</option>
               <option   @if(old('isPostPayInSudan')==1) selected @endif  value="1">نعم </option>
            </select>
               @error('isPostPayInSudan')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div> --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- <div class="col-md-4 relatedisPostPayInSudan" " style="display: none" >
         <div class="form-group">
            <label>     قيمة المبلغ المورد في البلد الام  </label>
            <input type="text" name="post_pay_amount" id="post_pay_amount" class="form-control" value="{{ old('post_pay_amount') }}" >
            @error('post_pay_amount')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        {{-- <div class="col-md-4 relatedisPostPayInSudan" " style="display: none" >
         <div class="form-group">
                  <label>     صورة ايصال بنكك   </label>
                  <input type="file" name="post_pay_pill_image" id="post_pay_pill_image" class="form-control" value="{{ old('post_pay_pill_image') }}" >
                  @error('post_pay_pill_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>    هل يمتلك رخصة قيادة سودانية</label>
                  <select  name="does_has_sudanese_Driving_License" id="does_has_sudanese_Driving_License" class="form-control">
                  <option @if(old('does_has_sudanese_Driving_License')==0 and old('does_has_sudanese_Driving_License')!="" ) selected @endif value="0">لا</option>
                  <option   @if(old('does_has_sudanese_Driving_License')==1) selected @endif  value="1">نعم </option>
               </select>
                  @error('does_has_Driving_License')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4 related_does_has_sudanese_Driving_License"  style="display: none;">
               <div class="form-group">
                  <label>  رقم رخصة القيادة في البلد الام</label>
                  <input type="text" name="sudanese_driving_License_number" id="sudanese_driving_License_number" class="form-control" value="{{ old('sudanese_driving_License_number') }}" >
                  @error('sudanese_driving_License_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
                </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4 related_does_has_sudanese_Driving_License"  style="display: none;">
               <div class="form-group">
                  <label>   نوع رخصة القيادةفي البلد الام</label>
                  <select name="sudanese_driving_license_types_id" id="sudanese_driving_license_types_id" class="form-control select2 ">
                     <option value="">اختر  الحالة </option>
                     @if (@isset($other['driving_license_types']) && !@empty($other['driving_license_types']))
                     @foreach ($other['driving_license_types'] as $info )
                     <option @if(old('sudanese_driving_license_types_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('sudanese_driving_license_types_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div> --}}
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4 related_does_has_sudanese_Driving_License"  style="display: none;">
               <div class="form-group">
                  <label>     صورة الرخصة في البلد الام   </label>
                  <input type="file" name="sudanese_driving_license_Image" id="sudanese_driving_license_Image" class="form-control" value="{{ old('sudanese_driving_license_Image') }}" >
                  @error('sudanese_driving_license_Image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(30)==true)

          <div class="col-md-4">
            <div class="form-group">
               <label> نوع التقديم  </label>
               <select  name="appointment_type" id="appointment_type" class="form-control">
               <option   @if(old('appointment_type')==1) selected @endif  value="1">قادم من البلد الام</option>
               <option   @if(old('appointment_type')==2) selected @endif  value="2">من داخل قطر (داخلي)</option>
            </select>
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         @elseif (check_permission_sub_menue_actions(28)==true ||check_permission_sub_menue_actions(29)==true)
         <div class="col-md-4">
            <div class="form-group">
             <label> نوع التقديم  </label>
             <input readonly type="text" name="appointment_type" id="appointment_type" class="form-control" 
             @if(old('appointment_type')==1) value="قادم من البلد الام"
             @else value="من داخل قطر (داخلي)"
              @endif 
              >
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         @endif

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4 related_appointment_type" ">
            <div class="form-group">
               <label> نوع العقد  </label>
               <select  name="contract_type" id="contract_type" class="form-control">
               <option   @if(old('contract_type')==1) selected @endif  value="1">عقد دائم (ثلاث سنوات)  </option>
               <option   @if(old('contract_type')==2) selected @endif  value="2">ينتهي بفسخ العقد   (6 شهور)</option>
            </select>
               @error('contract_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   
                  {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                  <div class="col-md-4 related_appointment_type" ">
                     <div class="form-group">
                     <label> توقيع العقد المبدئي   </label>
                     <select  name="isSigningInitialContract" id="isSigningInitialContract" class="form-control">
                     <option   @if(old('isSigningInitialContract')==0) selected @endif  value="0">لم يتم توقيع العقد المبدئي   </option>
                     <option   @if(old('isSigningInitialContract')==1) selected @endif  value="1">   تم توقيع العقد المبدئي </option>
                  </select>
                     @error('MotivationType')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
                  {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                  <div class="col-md-4 relatedisSigningInitialContract" " style="display: none" >
                     <div class="form-group">
                  <label>     صورة توقيع العقد المبدئي    </label>
                  <input type="file" name="initial_contract_image"" id="initial_contract_image" class="form-control" value="{{ old('initial_contract_image') }}" >
                  @error('initial_contract_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
               </div>   

               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4 related_appointment_type" ">
                  <div class="form-group">
                     <label>  اصدار التاشيرة   </label>
                     <select  name="isVisaPrinted" id="isVisaPrinted" class="form-control">
                        <option   @if(old('isVisaPrinted')==0) selected @endif  value="0"> لم يتم اصدار التاشيرة </option>
                     <option   @if(old('isVisaPrinted')==1) selected @endif  value="1"> تم اصدار التاشيرة </option>
                  </select>
                     @error('isVisaPrinted')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4 relatedisVisaPrinted" " style="display: none" >
               <div class="form-group">
                     <label>    رقم التاشيرة  </label>
                     <input autofocus type="text" name="visa_number" id="visa_number" class="form-control" value="{{ old('visa_number') }}" >
                     @error('visa_number')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4 relatedisVisaPrinted" " style="display: none" >
                  <div class="form-group">
                     <label>    تاريخ اصدار التاشيرة     </label>
                     <input autofocus type="date" name="visa_start_date" id="visa_start_date" class="form-control" value="{{ old('visa_start_date') }}" >
                     @error('visa_start_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4 relatedisVisaPrinted" " style="display: none" >
                  <div class="form-group">
                     <label>    تاريخ انتهاء التاشيرة     </label>
                     <input autofocus type="date" name="visa_end_date" id="visa_end_date" class="form-control" value="{{ old('visa_end_date') }}" >
                     @error('visa_end_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
                 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                 <div class="col-md-4 relatedisVisaPrinted" " style="display: none" >
                  <div class="form-group">
               <label>     صورة التاشيرة      </label>
               <input type="file" name="visa_image" id="visa_image" class="form-control" value="{{ old('visa_image') }}" >
               @error('visa_image')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>   

         
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
               <label>المستقدم</label>
               <input type="text" name="employer" id="employer" class="form-control" value="{{ old('employer') }}" >
               @error('employer')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
             </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
         <div class="form-group">
      <label>     صورة عدم الممانعة      </label>
      <input type="file" name="no_objection_image" id="no_objection_image" class="form-control" value="{{ old('no_objection_image') }}" >
      @error('no_objection_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>   
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
               <label>رقم الاقامة القديمة </label>
               <input type="text" name="old_qid_number" id="old_qid_number" class="form-control" value="{{ old('old_qid_number') }}" >
               @error('old_qid_number')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
             </div>
         </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
         <label>     صورة  الاقامة القديمة      </label>
         <input type="file" name="old_qid_image" id="old_qid_image" class="form-control" value="{{ old('old_qid_image') }}" >
         @error('old_qid_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>   
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

         <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
         <label>   تاريخ دخول قطر</label>
         <input  type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date') }}" >
         @error('arrive_qater_date')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>


            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


         <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
               <div class="form-group">
         <label>       حالة نقل الكفالة  </label>
         <select  name="sponsorship_transfer_status" id="sponsorship_transfer_status" class="form-control select2 ">
            <option value="">اختر حالة الاجراء</option>
            @if (@isset($other['sponsorship_transfer_status']) && !@empty($other['sponsorship_transfer_status']))
            @foreach ($other['sponsorship_transfer_status'] as $info )
            <option @if(old('sponsorship_transfer_status')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
            @endforeach
            @endif
         </select>
         @error('sponsorship_transfer_status')
         <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
       
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4">
            <div class="form-group">
               <label>   الصورة الشخصية للسائق</label>
               <input type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo') }}" >
               @error('driver_photo')
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
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف السائق </button>
                  <a href="{{ route('HumanResource.index') }}" class="btn btn-danger btn-sm">رجوع</a>
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
<script src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
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