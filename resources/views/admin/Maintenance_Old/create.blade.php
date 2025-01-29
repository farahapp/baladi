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
<a href="{{ route('Employees.index') }}">     الموظفين</a>
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
         <form action="{{ route('Employees.store') }}" method="post" enctype="multipart/form-data">
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
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">بيانات السائق في البلد الام</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="quater_data" data-toggle="pill" href="#custom-content-employee_quater_data" role="tab" aria-controls="custom-content-employee_quater_data" aria-selected="false">بيانات السائق القطرية</a>
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
                  <input type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name') }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
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
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
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
            <div class="col-md-4">
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
            <div class="col-md-4">
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
                  <input autofocus type="text" name="visa_end_date" id="visa_end_date" class="form-control" value="{{ old('visa_end_date') }}" >
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
            <div class="col-md-4">
               <div class="form-group">
                  <label>  نوع الجنس</label>
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
                  <label>جهة اصدار جواز السفر	</label>
                  <input type="text" name="driver_pasport_from" id="driver_pasport_from" class="form-control" value="{{ old('driver_pasport_from') }}" >
                  @error('driver_pasport_from')
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
            <div class="col-md-4">
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
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4 relatedisPostPayInSudan" " style="display: none" >
         <div class="form-group">
            <label>     قيمة المبلغ المورد في البلد الام  </label>
            <input type="text" name="post_pay_amount" id="post_pay_amount" class="form-control" value="{{ old('post_pay_amount') }}" >
            @error('post_pay_amount')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        <div class="col-md-4 relatedisPostPayInSudan" " style="display: none" >
         <div class="form-group">
                  <label>     صورة ايصال بنكك   </label>
                  <input type="file" name="post_pay_pill_image" id="post_pay_pill_image" class="form-control" value="{{ old('post_pay_pill_image') }}" >
                  @error('post_pay_pill_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
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
            <div class="col-md-4 related_does_has_sudanese_Driving_License"  style="display: none;">
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
            </div>
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
         <div class="col-md-4">
            <div class="form-group">
               <label>   الصورة الشخصية للسائق</label>
               <input type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('emp_photo') }}" >
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


          <div class="tab-pane fade" id="custom-content-employee_quater_data" role="tabpanel" aria-labelledby="quater_data">
            <br>
            <div class="row">
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>   تاريخ دخول قطر</label>
                  <input type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date') }}" >
                  @error('arrive_qater_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
                  {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label> استلام الجواز  </label>
                  <select  name="isGivePassPort" id="isGivePassPort" class="form-control">
                  <option   @if(old('isGivePassPort')==0) selected @endif  value="0">لم يتم تسليم الجواز  </option>
                  <option   @if(old('isGivePassPort')==1) selected @endif  value="1">   تم تسليم الجواز</option>
               </select>
                  @error('isGivePassPort')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4 relatedisGivePassPort" " style="display: none" >
            <div class="form-group">
            <label>     صورة توقيع اقرار تسليم الجواز   </label>
            <input type="file" name="give_passport_image" id="give_passport_image" class="form-control" value="{{ old('give_passport_image') }}" >
            @error('give_passport_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label> توقيع المديونية   </label>
                  <select  name="isSigningFullFinancialDebt" id="isSigningFullFinancialDebt" class="form-control">
                  <option   @if(old('isSigningFullFinancialDebt')==0) selected @endif  value="0">لم يتم توقيع المديونية   </option>
                  <option   @if(old('isSigningFullFinancialDebt')==1) selected @endif  value="1">   تم توقيع المديونية </option>
               </select>
                  @error('isSigningFullFinancialDebt')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4 relatedisSigningFullFinancialDebt" " style="display: none" >
            <div class="form-group">
            <label>     صورة توقيع المديونية    </label>
            <input type="file" name="SigningFullFinancialDebt_Image" id="SigningFullFinancialDebt_Image" class="form-control" value="{{ old('SigningFullFinancialDebt_Image') }}" >
            @error('SigningFullFinancialDebt_Image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label> توقيع الشرط الجزائي   </label>
                  <select  name="isSigningPenaltyClause" id="isSigningPenaltyClause" class="form-control">
                  <option   @if(old('isSigningPenaltyClause')==0) selected @endif  value="0">لم يتم توقيع الشرط الجزائي   </option>
                  <option   @if(old('isSigningPenaltyClause')==1) selected @endif  value="1">   تم توقيع الشرط الجزائي </option>
               </select>
                  @error('isSigningPenaltyClause')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4 relatedisSigningPenaltyClause" " style="display: none" >
               <div class="form-group">
            <label>     صورة توقيع الشرط الجزائي    </label>
            <input type="file" name="isSigningPenaltyClause_Image" id="isSigningPenaltyClause_Image" class="form-control" value="{{ old('isSigningPenaltyClause_Image') }}" >
            @error('isSigningPenaltyClause_Image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>   حالة الزي الرسمي   </label>
                  <select  name="uniform_status" id="uniform_status" class="form-control">
                  <option   @if(old('uniform_status')==1) selected @endif  value="0">لم يتم قياس مقاس الزي الرسمي </option>
                  <option   @if(old('uniform_status')==2) selected @endif  value="1">   تم قياس الزي الرسمي ولم يتم السليم     </option>
                  <option @if(old('uniform_status')==0 and old('uniform_status')!="" ) selected @endif value="2"> تم تسليم الزي الرسمي للسائق </option>
               </select>
                  @error('uniform_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                       <div class="col-md-4">
               <div class="form-group">
                  <label>     رقم الهاتف القطري </label>
                  <input type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel') }}" >
                  @error('driver_quater_tel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>      البريد الالكتروني</label>
                  <input type="text" name="driver_email" id="driver_email" class="form-control" value="{{ old('driver_email') }}" >
                  @error('driver_email')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>    
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4">
               <div class="form-group">
                  <label>    الحالة الوظيفية</label>
                  <select  name="Functional_status" id="Functional_status" class="form-control">
                  <option   @if(old('Functional_status')==1) selected @endif  value="1">يعمل</option>
                  <option @if(old('Functional_status')==0 and old('Functional_status')!="" ) selected @endif value="0">خارج الخدمة</option>
               </select>
                  @error('Functional_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له بصمة حضور وانصراف</label>
                  <select  name="does_has_ateendance" id="does_has_ateendance" class="form-control">
                  <option @if(old('does_has_ateendance')==0 and old('does_has_ateendance')!="" ) selected @endif value="0"> لا </option>
                  <option   @if(old('does_has_ateendance')==1) selected @endif  value="1">نعم</option>
               </select>
                  @error('does_has_ateendance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

          <div class="col-md-4">
            <div class="form-group">
               <label>       اجراءات اصدار الاقامة  </label>
               <select name="driver_residency_process_status" id="driver_residency_process_status" class="form-control select2 ">
                  <option value="">اختر حالة الاجراء</option>
                  @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
                  @foreach ($other['nationalities'] as $info )
                  <option @if(old('driver_residency_process_status')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
               @error('driver_residency_process_status')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

          <div class="col-md-4 related_driver_residency_process_status" " style="display: none" >
            <div class="form-group">
               <label>         رقم بطاقة الاقامة</label>
               <input type="text" name="driver_residency_permit_id" id="driver_residency_permit_id" class="form-control" value="{{ old('driver_residency_permit_id') }}" >
               @error('driver_residency_permit_id')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


         <div class="col-md-4 related_driver_residency_process_status" " style="display: none" >
            <div class="form-group">
               <label>         تاريخ انتهاء بطاقة الاقامة</label>
               <input type="date" name="driver_end_residencyIDate" id="driver_end_residencyIDate" class="form-control" value="{{ old('driver_end_residencyIDate') }}" >
               @error('driver_end_residencyIDate')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4 related_driver_residency_process_status" " style="display: none" >
               <div class="form-group">
                  <label>     صورة بطاقة الاقامة   </label>
                  <input type="file" name="driver_residency_id_Image" id="driver_residency_id_Image" class="form-control" value="{{ old('driver_residency_id_Image') }}" >
                  @error('driver_residency_id_Image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


                  <div class="col-md-4">
                     <div class="form-group">
                  <label>       اجراءات البنك واصدار دفتر الشيكات  </label>
                        <select name="driver_bank_process" id="driver_bank_process" class="form-control select2 ">
                           <option value="">اختر حالة البنك</option>
                           @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
                           @foreach ($other['nationalities'] as $info )
                           <option @if(old('driver_bank_process')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                           @endforeach
                           @endif
                        </select>
                        @error('driver_bank_process')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           
          <div class="col-md-4 related_driver_bank_process" " style="display: none" >
            <div class="form-group">
               <label>    رقم الحساب البنكي في حالة الاصدار </label>
               <input type="text" name="driver_bank_number" id="driver_bank_number" class="form-control" value="{{ old('driver_bank_number') }}" >
               @error('emp_national_idenity')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>


         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>     حالة المدرسة</label>
                  <select name="driving_school_status" id="driving_school_status" class="form-control select2 ">
                     <option value="">اختر حالة المدرسة</option>
                     @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
                     @foreach ($other['nationalities'] as $info )
                     <option @if(old('driving_school_status')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('driving_school_status')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
    {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
    
   <div class="col-md-4 related_driving_school_status" " style="display: none" >
      <div class="form-group">
         <label> رقم رخصة القيادة القطرية    </label>
         <input type="text" name="driving_permit_number" id="driving_permit_number" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('driving_permit_number') }}" >
         @error('driving_permit_number')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   <div class="col-md-4 related_driving_school_status" " style="display: none" >
      <div class="form-group">
         <label>     صورة رخصة القيادة  </label>
         <input type="file" name="driving_permit_image" id="emp_CV" class="form-control" value="{{ old('driving_permit_image') }}" >
         @error('driving_permit_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له تأمين طبي </label>
                  <select  name="ismedicalinsurance" id="ismedicalinsurance" class="form-control">
                     <option value="">اختر الحالة</option>
                  <option   @if(old('ismedicalinsurance')==1) selected @endif  value="1">نعم</option>
                  <option @if(old('ismedicalinsurance')==0 and old('ismedicalinsurance')!="" ) selected @endif value="0"> لا </option>
               </select>
                  @error('ismedicalinsurance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            

            <div class="col-md-4 relatedismedicalinsurance" " style="display: none" >
               <div class="form-group">
                  <label> رقم التامين الطبي للسائق</label>
                  <input type="text" name="medicalinsuranceNumber" id="medicalinsuranceNumber" class="form-control" value="{{ old('medicalinsuranceNumber') }}" >
                  @error('medicalinsuranceNumber')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-12">
            <div class="form-group">
               <label>       عنوان الاقامة داخل قطر </label>
               <input type="text" name="qater_staies_address" id="qater_staies_address" class="form-control" value="{{ old('qater_staies_address') }}" >
               @error('qater_staies_address')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      
          <div class="col-md-12 " >
            <div class="form-group">
               <label> ملاحظات علي الموظف </label>
               <textarea type="text" name="driver_notes" id="notes" class="form-control" >
                  {{ old('driver_notes') }}

               </textarea>
               @error('driver_notes')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       
      
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
                  <a href="{{ route('Religions.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   
   
   </div>
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