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
تحديث
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تحديث بيانات سائق 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Training.update',$data['id']) }}" method="post" enctype="multipart/form-data">
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
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">بيانات السائق ال{{ $data->Nationalities->name }}</a>
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
                  <input readonly type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name',$data['driver_name']) }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>    الجنسية   </label>
                  <input readonly type="text" name="nationalities" id="nationalities" class="form-control" value="{{ old('nationalities',$data->Nationalities->name) }}" >
                  @error('nationalities')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
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

            <div class="col-md-4">
               <div class="form-group">
                  <label> نوع العقد  </label>
                <input readonly type="text" name="contract_type" id="contract_type" class="form-control" 
                @if(old('contract_type',$data['contract_type'])==1) value="عقد دائم (ثلاث سنوات)"
                @else value="ينتهي بفسخ العقد   (6 شهور)"
                 @endif 
                 >
                  @error('contract_type')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            
            <div class="col-md-4">
               <div class="form-group">
                  <label>  نوع الجنس</label>
                <input readonly type="text" name="driver_gender" id="driver_gender" class="form-control" 
                @if(old('driver_gender',$data['driver_gender'])==1) value="ذكر"
                @else value="انثي"
                 @endif 
                 >
                  @error('driver_gender')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
            <div class="col-md-4">
               <div class="form-group">
                  <label>        تاريخ الميلاد</label>
                  <input readonly type="date" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date',$data['brith_date']) }}" >
                  @error('brith_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            
            <div class="col-md-4 " >
               <div class="form-group">
                  <label>   رقم جواز السفر  	</label>
                  <input readonly type="text" name="driver_pasport_no" id="driver_pasport_no" class="form-control" value="{{ old('driver_pasport_no',$data['driver_pasport_no']) }}" >
                  @error('driver_pasport_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                
            <div class="col-md-4">
               <div class="form-group">
                  <label> توقيع العقد المبدئي   </label>
                <input readonly type="text" name="isSigningInitialContract" id="isSigningInitialContract" class="form-control" 
                @if(old('isSigningInitialContract',$data['isSigningInitialContract'])==0) value="لم يتم توقيع العقد المبدئي"
                @else value="تم توقيع العقد المبدئي"
                 @endif 
                 >
                  @error('isSigningInitialContract')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
 


                         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

         <div class="col-md-4">
            <div class="form-group">
               <label>   هل يحمل رخصة سودانية سارية 	</label>
             <input readonly type="text" name="does_has_sudanese_Driving_License" id="does_has_sudanese_Driving_License" class="form-control" 
             @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==0) value="ليس لديه رخصة سودانية"
             @else value="لديه رخصة سودانية"
              @endif 
              >
               @error('does_has_sudanese_Driving_License')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4">
            <div class="form-group">
               <label>   صورة الرخصة في البلد الام</label>
               @if ($data['sudanese_driving_license_Image']!=null ||$data['sudanese_driving_license_Image']!="")
                  <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['sudanese_driving_license_Image'] }}" alt="صورة الرخصة في البلد الام" >
                  @endif
            </div>
         </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}          
            <div class="col-md-4">
               <div class="form-group">
                  <label>   الصورة الشخصية للسائق</label>
                  @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                     <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">عرض </button>
                     @endif
               </div>
            </div>
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
                  <input readonly type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date',$data['arrive_qater_date']) }}" >
                  @error('arrive_qater_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
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

            <div class="col-md-4">
               <div class="form-group">
                  <label> استلام الجواز  </label>
                <input readonly type="text" name="isGivePassPort" id="isGivePassPort" class="form-control" 
                @if(old('isGivePassPort',$data['isGivePassPort'])==0) value="لم يتم تسليم الجواز"
                @else value="تم تسليم الجواز"
                 @endif 
                 >
                  @error('isGivePassPort')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label> توقيع المديونية   </label>
                <input readonly type="text" name="isSigningFullFinancialDebt" id="isSigningFullFinancialDebt" class="form-control" 
                @if(old('isSigningFullFinancialDebt',$data['isSigningFullFinancialDebt'])==0) value="لم يتم توقيع المديونية"
                @else value="تم توقيع المديونية"
                 @endif 
                 >
                  @error('isSigningFullFinancialDebt')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


            <div class="col-md-4">
               <div class="form-group">
                  <label> توقيع الشرط الجزائي   </label>
                <input readonly type="text" name="isSigningPenaltyClause" id="isSigningPenaltyClause" class="form-control" 
                @if(old('isSigningPenaltyClause',$data['isSigningPenaltyClause'])==0) value="لم يتم توقيع الشرط الجزائي"
                @else value="تم توقيع الشرط الجزائي"
                 @endif 
                 >
                  @error('isSigningPenaltyClause')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(27)==true)
       <div class="col-md-4">
         <div class="form-group">
      <label>       اجراءات المدرسة واستخراج رخصة القيادة  </label>
            <select readonly name="driving_school_status" id="driving_school_status" class="form-control select2 ">
               <option  value="">اختر حالة المدرسة</option>
               @if (@isset($other['driving_school_status']) && !@empty($other['driving_school_status']))
               @foreach ($other['driving_school_status'] as $info )
               <option @if(old('driving_school_status',$data['driving_school_status'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
               @endforeach
               @endif
            </select>
            @error('driving_school_status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4 relatedDriving_school_status"
       @if($data['driving_school_status']!='10')style="display: none" @endif >
         <div class="form-group" id="qatary_driving_license_Image_image_oldImage">
            <label>     صورة   الرخصة القطرية    </label>
            <div class="image">
               @if ($data['qatary_driving_license_Image_image']!=null ||$data['qatary_driving_license_Image_image']!="")
               <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['qatary_driving_license_Image_image'] }}" alt="صورة الرخصة القطرية" ><br/>
               <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['qatary_driving_license_Image_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
               @endif 
               <button type="button" class="btn btn-sm btn-info" id="change_qatary_driving_license_Image_image" style="width:100px;" value="change_qatary_driving_license_Image_image">إختيار صورة</button>
               <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_qatary_driving_license_Image_image">الغاء </button>

           </div>
            {{-- <input readonly type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo',$data['driver_photo']) }}" > --}}
            @error('qatary_driving_license_Image_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(22)==true)
      <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الحضور لمحاضرة الانجليزي    </label>
            <select    name="english_lectures_atendence_range" id="english_lectures_atendence_range" class="form-control">
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('english_lectures_atendence_range',$data['english_lectures_atendence_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('english_lectures_atendence_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الاستيعاب لمحاضرة الانجليزي    </label>
            <select  name="english_lectures_understand_range" id="english_lectures_understand_range" class="form-control">
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('english_lectures_understand_range',$data['english_lectures_understand_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('english_lectures_understand_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(23)==true)
      <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الحضور لدرس طلبات    </label>
            <select  name="talabat_lectures_atendence_range" id="talabat_lectures_atendence_range" class="form-control">
               <option   @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option   @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('talabat_lectures_atendence_range',$data['talabat_lectures_atendence_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('talabat_lectures_atendence_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الاستيعاب لدرس طلبات    </label>
            <select  name="talabat_lectures_understand_range" id="talabat_lectures_understand_range" class="form-control">
               <option   @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option   @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('talabat_lectures_understand_range',$data['talabat_lectures_understand_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('talabat_lectures_understand_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(24)==true)
      <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الحضور لدرس الاتكيت و الذوق العام    </label>
            <select  name="atucate_lectures_atendence_range" id="atucate_lectures_atendence_range" class="form-control">
               <option   @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option   @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('atucate_lectures_atendence_range',$data['atucate_lectures_atendence_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('atucate_lectures_atendence_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
         <div class="form-group">
            <label>       تقييم الاستيعاب لدرس الاتكيت و الذوق العام    </label>
            <select  name="atucate_lectures_understand_range" id="atucate_lectures_understand_range" class="form-control">
               <option   @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==0) selected @endif  value="0">لم يبداء</option>
            <option   @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('atucate_lectures_understand_range',$data['atucate_lectures_understand_range'])==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
            @error('atucate_lectures_understand_range')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(25)==true)
 <div class="col-md-4">
   <div class="form-group">
      <label>       تقييم   تدريب السواقة   </label>
      <select  name="driving_traning_range" id="driving_traning_range" class="form-control">
         <option   @if(old('driving_traning_range',$data['driving_traning_range'])==0) selected @endif  value="0">لم يبداء</option>
         <option   @if(old('driving_traning_range',$data['driving_traning_range'])==1) selected @endif  value="1">ممتاز</option>
         <option @if(old('driving_traning_range',$data['driving_traning_range'])==2 ) selected @endif value="2">جيد جدا</option>
      <option @if(old('driving_traning_range',$data['driving_traning_range'])==3 ) selected @endif value="3">مقبول</option>
      <option @if(old('driving_traning_range',$data['driving_traning_range'])==4 ) selected @endif value="4">سيئ</option>
      <option @if(old('driving_traning_range',$data['driving_traning_range'])==5 ) selected @endif value="5">سيئ جدا </option>
      </select>
      @error('driving_traning_range')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
@endif
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
@if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(26)==true)
<div class="col-md-4">
   <div class="form-group">
      <label>       تقييم    السواقة داخل الدوحة   </label>
      <select  name="driving_in_doha_traning_range" id="driving_in_doha_traning_range" class="form-control">
         <option   @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==0) selected @endif  value="0">لم يبداء</option>
         <option   @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==1) selected @endif  value="1">ممتاز</option>
         <option @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==2 ) selected @endif value="2">جيد جدا</option>
      <option @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==3 ) selected @endif value="3">مقبول</option>
      <option @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==4 ) selected @endif value="4">سيئ</option>
      <option @if(old('driving_in_doha_traning_range',$data['driving_in_doha_traning_range'])==5 ) selected @endif value="5">سيئ جدا </option>
      </select>
      @error('driving_in_doha_traning_range')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
@endif
{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}



      
      
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
                  <a href="{{ route('Training.index') }}" class="btn btn-danger btn-sm">الغاء</a>
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
 if($(this).val()!=10 ){
$(".relatedDriving_school_status").hide();
 }else{
   $(".relatedDriving_school_status").show();

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