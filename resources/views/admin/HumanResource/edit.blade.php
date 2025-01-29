@extends('layouts.admin')
@section('title')
Drivers Data
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('HumanResource.index') }}">     Drivers</a>
@endsection
@section('contentheaderactive')
Modify
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Modify Driver Data {{$data['driver_name']}}   
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('HumanResource.update',$data['id']) }}" method="post" enctype="multipart/form-data">
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
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">Driver data {{ $data->Nationalities->name }}</a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link" id="quater_data" data-toggle="pill" href="#custom-content-employee_quater_data" role="tab" aria-controls="custom-content-employee_quater_data" aria-selected="false">Qatari Driver Data</a>
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
                  <input  type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name',$data['driver_name']) }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
                 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                 <div class="col-md-4">
                  <div class="form-group">
                     <label>   Arabic Name    </label>
                     <input  type="text" name="driver_english_name" id="driver_english_name" class="form-control" value="{{ old('driver_english_name',$data['driver_english_name']) }}" >
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
            <option @if(old('branches',$data['branches'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
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
                     <input  type="text" name="baladi_id" id="baladi_id" class="form-control" value="{{ old('baladi_id',$data['baladi_id']) }}" >
                     @error('baladi_id')
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

               {{-- <div class="col-md-4">
                  <div class="form-group">
                     <label>  Job Type </label>
                     <select   name="job_type" id="job_type" class="form-control">
                        <option @if(old('job_type',$data['job_type'])==1) selected @endif  value="1">ليموزين</option>
                        <option @if(old('job_type',$data['job_type'])==2 ) selected @endif value="2">ديلفري</option>
                        <option @if(old('job_type',$data['job_type'])==3) selected @endif  value="3">إداري</option>
                        <option @if(old('job_type',$data['job_type'])==4 ) selected @endif value="4">إعارة</option>
                     
                     </select>
                     @error('job_type')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}

            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- <div class="col-md-4 related_job_type" @if($data['job_type']!=2) style="display: none" @endif >
               <div class="form-group">
                     <label>  Delivery Type</label>
                     <select   name="delevery_type" id="delevery_type" class="form-control">
                     <option   @if(old('delevery_type',$data['delevery_type'])==1) selected @endif  value="1">Car driver</option>
                     <option @if(old('delevery_type',$data['delevery_type'])==2 ) selected @endif value="2">Bike Rider</option>
                     </select>
                     @error('delevery_type')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}

            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group">
                     <label>  Gender</label>
                     <select   name="driver_gender" id="driver_gender" class="form-control">
                     <option   @if(old('driver_gender',$data['driver_gender'])==1) selected @endif  value="1">male</option>
                     <option @if(old('driver_gender',$data['driver_gender'])==2 ) selected @endif value="2">female</option>
                     </select>
                     @error('driver_gender')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    Birth Date</label>
                     <input  type="date" data-date="" data-date-format="DD MMMM YYYY" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date',$data['brith_date']) }}" >
                     @error('brith_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group">
                     <label>  Marital Status </label>
                     <select  name="marital_status" id="marital_status" class="form-control">
                     <option   @if(old('marital_status',$data['marital_status'])==0) selected @endif  value="0">Single</option>
                     <option   @if(old('marital_status',$data['marital_status'])==1) selected @endif  value="1">Married</option>
                  </select>
                     @error('marital_status')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4 related_marital_status " @if($data['marital_status']==0) style="display: none" @endif >
               <div class="form-group">
                     <label> Children Number</label>
                     <input  type="text" name="sons_number" id="sons_number" oninput="this.value=this.value.replace(/[^0-9.]/g,'');" class="form-control" value="{{ old('sons_number',$data['sons_number']) }}" >
                     @error('sons_number')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
                      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4 ">
                  <div class="form-group">
                     <label>   Passport Number </label>
                     <input  type="text" name="driver_pasport_no" id="driver_pasport_no" class="form-control" value="{{ old('driver_pasport_no',$data['driver_pasport_no']) }}" >
                     @error('driver_pasport_no')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                  <div class="col-md-4 " >
                  <div class="form-group">
                     <label>  Passport Expiry Date	</label>
                     <input  type="date" name="driver_pasport_exp" id="driver_pasport_exp" class="form-control" value="{{ old('driver_pasport_exp',$data['driver_pasport_exp']) }}" >
                     @error('driver_pasport_exp')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-4">
                  <div class="form-group" id="driver_pasport_image_oldImage">
                     <label>     Passport photo  </label>
                     <div class="image">
                        @if ($data['driver_pasport_image']!=null ||$data['driver_pasport_image']!="")
   
                        @if (pathinfo($data['driver_pasport_image'], PATHINFO_EXTENSION) == 'pdf')
                        <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_pasport_image'] }}"></iframe><br/>
                        @else
                        <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_pasport_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                        @endif
                        <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_pasport_image'] }}" style="width:50px;" value="driver_pasport_image">عرض </button>
                        @endif
                        <button type="button" class="btn btn-sm btn-info" id="change_driver_pasport_image" style="width:100px;" value="driver_pasport_image" >Select image</button>
                        <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_driver_pasport_image">Cancel</button>
                    </div>
                     @error('driver_pasport_image')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}      
               <div class="col-md-4">
                  <div class="form-group">
                     <label>   Educational qualification</label>
                     <select  name="Qualifications_id" id="Qualifications_id  " class="form-control select2 ">
                        <option value="">Select qualification</option>
                        @if (@isset($other['qualifications']) && !@empty($other['qualifications']))
                        @foreach ($other['qualifications'] as $info )
                        <option @if(old('Qualifications_id',$data['Qualifications_id'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
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
                     <input  type="text" name="driver_sudan_tel" id="driver_sudan_tel" class="form-control" value="{{ old('driver_sudan_tel',$data['driver_sudan_tel']) }}" >
                     @error('driver_sudan_tel')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
               <div class="col-md-12">
                  <div class="form-group">
                     <label>   Driver's residence address in the home country </label>
                     <input  type="text" name="sudan_driver_Basic_stay_address" id="sudan_driver_Basic_stay_address" class="form-control" value="{{ old('sudan_driver_Basic_stay_address',$data['sudan_driver_Basic_stay_address']) }}" >
                     @error('sudan_driver_Basic_stay_address')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
                   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
{{-- 
               <div class="col-md-4">
                  <div class="form-group">
                     <label>    هل يمتلك رخصة قيادة سودانية</label>
                     <select   name="does_has_sudanese_Driving_License" id="does_has_sudanese_Driving_License" class="form-control">
                     <option @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==0 and old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])!="" ) selected @endif value="0">لا</option>
                     <option   @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==1) selected @endif  value="1">نعم </option>
                  </select>
                     @error('does_has_Driving_License')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}

             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   
{{--    
               <div class="col-md-4 related_does_has_sudanese_Driving_License"  @if($data['does_has_sudanese_Driving_License']==0) style="display: none" @endif>
                  <div class="form-group" id="sudanese_driving_license_Image_oldImage">
                     <label>     صورة الرخصة في البلد الام   </label>
                     <div class="image">
                        @if ($data['sudanese_driving_license_Image']!=null ||$data['sudanese_driving_license_Image']!="")
   
                        @if (pathinfo($data['sudanese_driving_license_Image'], PATHINFO_EXTENSION) == 'pdf')
                        <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['sudanese_driving_license_Image'] }}"></iframe><br/>
                        @else
                        <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['sudanese_driving_license_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                        @endif
                        <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['sudanese_driving_license_Image'] }}" style="width:50px;" value="sudanese_driving_license_Image">عرض </button>
                        @endif
                        <button type="button" class="btn btn-sm btn-info" id="change_sudanese_driving_license_Image" style="width:100px;" value="sudanese_driving_license_Image" >Select image </button>
                        <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_sudanese_driving_license_Image">Cancel </button>
                    </div>
                     @error('sudanese_driving_license_Image')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(30)==true)

          <div class="col-md-4">
            <div class="form-group">
               <label> Submission type  </label>
               <select  name="appointment_type" id="appointment_type" class="form-control">
               <option   @if(old('appointment_type',$data['appointment_type'])==1) selected @endif  value="1"> Coming from home country</option>
               <option   @if(old('appointment_type',$data['appointment_type'])==2) selected @endif  value="2">From within Qatar (internal)</option>
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
             @if(old('appointment_type',$data['appointment_type'])==1) value=" Coming from home country  "
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
         {{-- <div class="col-md-4 related_appointment_type" " @if($data['appointment_type']!=1) style="display: none" @endif >
         <div class="form-group">
                  <label> توقيع العقد المبدئي   </label>
                  <select   name="isSigningInitialContract" id="isSigningInitialContract" class="form-control">
                  <option   @if(old('isSigningInitialContract',$data['isSigningInitialContract'])==0) selected @endif  value="0">لم يتم توقيع العقد المبدئي   </option>
                  <option   @if(old('isSigningInitialContract',$data['isSigningInitialContract'])==1) selected @endif  value="1">   تم توقيع العقد المبدئي </option>
               </select>
                  @error('MotivationType')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- <div class="col-md-4 related_appointment_type" " @if($data['appointment_type']!=1) style="display: none" @endif >
               <div class="form-group">
                     <label> نوع العقد  </label>
                     <select   name="contract_type" id="contract_type" class="form-control">
                     <option   @if(old('contract_type',$data['contract_type'])==1) selected @endif  value="1">عقد دائم (ثلاث سنوات)  </option>
                     <option   @if(old('contract_type',$data['contract_type'])==2) selected @endif  value="2">ينتهي بفسخ العقد   (6 شهور)</option>
                  </select>
                     @error('contract_type')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}
          
             
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          {{-- <div class="col-md-4 related_appointment_type" " @if($data['appointment_type']!=1) style="display: none" @endif >
            <div class="form-group">
                  <label>  اصدار التاشيرة   </label>
                  <select  name="isVisaPrinted" id="isVisaPrinted" class="form-control">
                     <option   @if(old('isVisaPrinted',$data['isVisaPrinted'])==0) selected @endif  value="0"> لم يتم اصدار التاشيرة </option>
                  <option   @if(old('isVisaPrinted',$data['isVisaPrinted'])==1) selected @endif  value="1"> تم اصدار التاشيرة </option>
               </select>
                  @error('isVisaPrinted')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          {{-- <div class="col-md-4 relatedisVisaPrinted" " @if($data['isVisaPrinted']==0) style="display: none" @endif >
            <div class="form-group">
                  <label>    رقم التاشيرة  </label>
                  <input   type="text" name="visa_number" id="visa_number" class="form-control" value="{{ old('visa_number',$data['visa_number']) }}" >
                  @error('visa_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4 relatedisVisaPrinted" " @if($data['isVisaPrinted']==0) style="display: none" @endif >
               <div class="form-group">
                  <label>    تاريخ اصدار التاشيرة     </label>
                  <input  type="date" name="visa_start_date" id="visa_start_date" class="form-control" value="{{ old('visa_start_date',$data['visa_start_date']) }}" >
                  @error('visa_start_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4 relatedisVisaPrinted" " @if($data['isVisaPrinted']==0) style="display: none" @endif >
               <div class="form-group">
                  <label>    تاريخ انتهاء التاشيرة     </label>
                  <input  type="date" name="visa_end_date" id="visa_end_date" class="form-control" value="{{ old('visa_end_date',$data['visa_end_date']) }}" >
                  @error('visa_end_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            {{-- <div class="col-md-4 relatedisVisaPrinted" " @if($data['isVisaPrinted']==0) style="display: none" @endif>
               <div class="form-group" id="visa_image_oldImage">
                  <label>     صورة التاشيرة      </label>
                  <div class="image">
                     @if ($data['visa_image']!=null ||$data['visa_image']!="")

                     @if (pathinfo($data['visa_image'], PATHINFO_EXTENSION) == 'pdf')
                     <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['visa_image'] }}"></iframe><br/>
                     @else
                     <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['visa_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                     @endif
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['visa_image'] }}" style="width:50px;" value="visa_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_visa_image" style="width:100px;" value="visa_image" >Select image</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_visa_image">Cancel </button>
                 </div>
                  @error('visa_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}

                      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4">
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
         </div> --}}
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- <div class="col-md-4 relatedisPostPayInSudan" " @if($data['isPostPayInSudan']==0) style="display: none" @endif >
         <div class="form-group">
            <label>     قيمة المبلغ المورد في البلد الام  </label>
            <input  type="text" name="post_pay_amount" id="post_pay_amount" class="form-control" value="{{ old('post_pay_amount',$data['post_pay_amount']) }}" >
            @error('post_pay_amount')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
{{--    
            <div class="col-md-4 relatedisPostPayInSudan" " @if($data['isPostPayInSudan']==0) style="display: none" @endif>
               <div class="form-group" id="post_pay_pill_image_oldImage">
                  <label>     صورة ايصال بنكك   </label>
                  <div class="image">
                     @if ($data['post_pay_pill_image']!=null ||$data['post_pay_pill_image']!="")

                     @if (pathinfo($data['post_pay_pill_image'], PATHINFO_EXTENSION) == 'pdf')
                     <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['post_pay_pill_image'] }}"></iframe><br/>
                     @else
                     <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['post_pay_pill_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
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
            </div> --}}
         


            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
            <div class="form-group">
               <label>The recruiting company</label>
               <input type="text" name="employer" id="employer" class="form-control" value="{{ old('employer',$data['employer']) }}" >
               @error('employer')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
             </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       {{-- <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
         <div class="form-group">
      <label>     صورة عدم الممانعة      </label>
      <input type="file" name="no_objection_image" id="no_objection_image" class="form-control" value="{{ old('no_objection_image',$data['no_objection_image']) }}" >
      @error('no_objection_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>    --}}

<div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
   <div class="form-group" id="no_objection_image_oldImage">
      <label>      No Objection Image       </label>
      <div class="image">
         @if ($data['no_objection_image']!=null ||$data['no_objection_image']!="")

         @if (pathinfo($data['no_objection_image'], PATHINFO_EXTENSION) == 'pdf')
         <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['no_objection_image'] }}"></iframe><br/>
         @else
         <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['no_objection_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
         @endif
         <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['no_objection_image'] }}" style="width:50px;" value="no_objection_image">Show</button>
         @endif
         <button type="button" class="btn btn-sm btn-info" id="change_no_objection_image" style="width:100px;" value="no_objection_image" >Select image</button>
         <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_no_objection_image">Cancel</button>
     </div>
      @error('no_objection_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         {{-- <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
            <div class="form-group">
               <label>رقم الاقامة القديمة </label>
               <input type="text" name="old_qid_number" id="old_qid_number" class="form-control" value="{{ old('old_qid_number',$data['old_qid_number']) }}" >
               @error('old_qid_number')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
             </div>
         </div> --}}
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         {{-- <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
            <div class="form-group">
         <label>     صورة  الاقامة القديمة      </label>
         <input type="file" name="old_qid_image" id="old_qid_image" class="form-control" value="{{ old('old_qid_image',$data['old_qid_image']) }}" >
         @error('old_qid_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>    --}}

{{-- 
   <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
      <div class="form-group" id="old_qid_image_oldImage">
         <label>     صورة  الاقامة القديمة      </label>
         <div class="image">
            @if ($data['old_qid_image']!=null ||$data['old_qid_image']!="")
   
            @if (pathinfo($data['old_qid_image'], PATHINFO_EXTENSION) == 'pdf')
            <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['old_qid_image'] }}"></iframe><br/>
            @else
            <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['old_qid_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            @endif
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['old_qid_image'] }}" style="width:50px;" value="old_qid_image">Show </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_old_qid_image" style="width:100px;" value="old_qid_image" >Select image</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_old_qid_image">Cancel </button>
        </div>
         @error('old_qid_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div> --}}

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

         {{-- <div class="col-md-4 related_appointment_type_second_value" " style="display: none" >
            <div class="form-group">
         <label>   تاريخ دخول قطر</label>
         <input  type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date') }}" >
         @error('arrive_qater_date')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
      </div> --}}


            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

{{-- 
         <div class="col-md-4 related_appointment_type_second_value" " @if($data['appointment_type']==1) style="display: none" @endif >
               <div class="form-group">
         <label>       حالة نقل الكفالة  </label>
         <select  name="sponsorship_transfer_status" id="sponsorship_transfer_status" class="form-control select2 ">
            <option value="">اختر حالة الاجراء</option>
            @if (@isset($other['sponsorship_transfer_status']) && !@empty($other['sponsorship_transfer_status']))
            @foreach ($other['sponsorship_transfer_status'] as $info )
            <option @if(old('sponsorship_transfer_status',$data['sponsorship_transfer_status'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
            @endforeach
            @endif
         </select>
         @error('sponsorship_transfer_status')
         <span class="text-danger">{{ $message }}</span>
         @enderror
      </div>
   </div>
 --}}

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-12">
            <div class="form-group" id="driver_photo_oldImage">
               <label>   Driver's photo</label>
               <div class="image">
                  @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                  <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:50px;" value="initial_contract_image">Show </button>
                  @endif
                  <button type="button" class="btn btn-sm btn-info" id="change_driver_photo" style="width:100px;" value="driver_photo" >Select image</button>
                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_driver_photo">Cancel </button>
              </div>
               {{-- <input  type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo',$data['driver_photo']) }}" > --}}
               @error('driver_photo')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
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
                  <label>   Entry Qatar Date</label>
                  <input  type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date',$data['arrive_qater_date']) }}" >
                  @error('arrive_qater_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
  
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                       <div class="col-md-4">
               <div class="form-group">
                  <label> Driver Quater Tel </label>
                  <input  type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data['driver_quater_tel']) }}" >
                  @error('driver_quater_tel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label> driver_email </label>
                  <input  type="text" name="driver_email" id="driver_email" class="form-control" value="{{ old('driver_email',$data['driver_email']) }}" >
                  @error('driver_email')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>    
   
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          {{-- <div class="col-md-4">
               <div class="form-group">
                  <label>  هل  له بصمة حضور وانصراف</label>
                  <select  name="does_has_ateendance" id="does_has_ateendance" class="form-control">
                  <option @if(old('does_has_ateendance',$data['does_has_ateendance'])==0 and old('does_has_ateendance',$data['post_pay_pill_image'])!="" ) selected @endif value="0"> لا </option>
                  <option   @if(old('does_has_ateendance',$data['does_has_ateendance'])==1) selected @endif  value="1">نعم</option>
               </select>
                  @error('does_has_ateendance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                {{-- <div class="col-md-4 related_does_has_ateendance" " @if($data['does_has_ateendance']!=1) style="display: none" @endif>
                  <div class="form-group">
                     <label>      رقم الموظف في جهاز البصمة </label>
                     <input  type="text" name="ateendance_device_no" id="ateendance_device_no" class="form-control" value="{{ old('ateendance_device_no',$data['ateendance_device_no']) }}" >
                     @error('ateendance_device_no')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div> --}}
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}   
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
{{-- 
          <div class="col-md-4">
            <div class="form-group">
               <label>       اجراءات اصدار الاقامة  </label>
               <select  name="driver_residency_process_status" id="driver_residency_process_status" class="form-control select2 ">
                  <option value="">اختر حالة الاجراء</option>
                  @if (@isset($other['residency_process_status']) && !@empty($other['residency_process_status']))
                  @foreach ($other['residency_process_status'] as $info )
                  <option @if(old('driver_residency_process_status',$data['driver_residency_process_status'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
               @error('driver_residency_process_status')
               <span class="text-danger">{{ $message }}</span>
               @enderror
            </div>
         </div> --}}

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

          <div class="col-md-4 related_driver_residency_process_status" " @if($data['driver_residency_process_status']!=11) style="display: none" @endif>
            <div class="form-group">
               <label>    Driver Residency Permit Id  </label>
               <input  type="text" name="driver_residency_permit_id" id="driver_residency_permit_id" class="form-control" value="{{ old('driver_residency_permit_id',$data['driver_residency_permit_id']) }}" >
               @error('driver_residency_permit_id')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


         <div class="col-md-4 related_driver_residency_process_status" " @if($data['driver_residency_process_status']!=11) style="display: none" @endif>
            <div class="form-group">
               <label>          Driver End Residency Date  </label>
               <input  type="date" name="driver_end_residencyIDate" id="driver_end_residencyIDate" class="form-control" value="{{ old('driver_end_residencyIDate',$data['driver_end_residencyIDate']) }}" >
               @error('driver_end_residencyIDate')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         

             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-4 related_driver_residency_process_status" " @if($data['driver_residency_process_status']!=11) style="display: none" @endif>
               <div class="form-group" id="driver_residency_id_Image_oldImage">
               <label>Driver Residency Id Image</label>
               <div class="image">
                  @if ($data['driver_residency_id_Image']!=null ||$data['driver_residency_id_Image']!="")
                  <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_residency_id_Image'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_residency_id_Image'] }}" style="width:50px;" value="driver_residency_id_Image">Show </button>
                  @endif
                  <button type="button" class="btn btn-sm btn-info" id="change_driver_residency_id_Image" style="width:100px;" value="driver_residency_id_Image" >Select image</button>
                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_driver_residency_id_Image">Cancel </button>
              </div>
               {{-- <input  type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo',$data['driver_photo']) }}" > --}}
               @error('driver_residency_id_Image')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>

         
       
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
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

{{-- 
                  <div class="col-md-4">
                     <div class="form-group">
                  <label>       اجراءات البنك واصدار دفتر الشيكات  </label>
                        <select  name="driver_bank_process" id="driver_bank_process" class="form-control select2 ">
                           <option value="">اختر حالة البنك</option>
                           @if (@isset($other['driver_bank_process']) && !@empty($other['driver_bank_process']))
                           @foreach ($other['driver_bank_process'] as $info )
                           <option @if(old('driver_bank_process',$data['driver_bank_process'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                           @endforeach
                           @endif
                        </select>
                        @error('driver_bank_process')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                  </div> --}}
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           
          <!--<div class="col-md-4 related_driver_bank_process"  @if($data['driver_bank_process']!=10) style="display: none" @endif >-->
             {{-- <div class="col-md-4">
            <div class="form-group">
               <label>    رقم الحساب البنكي </label>
               <input  type="text" name="driver_bank_number" id="driver_bank_number" class="form-control" value="{{ old('driver_bank_number',$data['driver_bank_number']) }}" >
               @error('emp_national_idenity')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div> --}}

 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            <div class="col-md-4">
               <div class="form-group">
                  <label> Does he have health insurance? </label>
                  <select  name="ismedicalinsurance" id="ismedicalinsurance" class="form-control">
                     <option value="">Select status</option>
                  <option   @if(old('ismedicalinsurance',$data['ismedicalinsurance'])==1) selected @endif  value="1">Yes</option>
                  <option @if(old('ismedicalinsurance',$data['ismedicalinsurance'])==0 and old('ismedicalinsurance',$data['ismedicalinsurance'])!="" ) selected @endif value="0"> No</option>
               </select>
                  @error('ismedicalinsurance')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            

            <div class="col-md-4 relatedismedicalinsurance" " @if($data['ismedicalinsurance']==0) style="display: none" @endif >
               <div class="form-group">
                  <label> Driver's medical insurance number </label>
                  <input  type="text" name="medicalinsuranceNumber" id="medicalinsuranceNumber" class="form-control" value="{{ old('medicalinsuranceNumber',$data['medicalinsuranceNumber']) }}" >
                  @error('medicalinsuranceNumber')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
  {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
  <div class="col-md-4">
   <div class="form-group">
      <label>    Functional Status</label>
      <select   name="Functional_status" id="Functional_status" class="form-control">
         <option   @if(old('Functional_status',$data['Functional_status'])==1) selected @endif  value="1">Training</option>
         <option   @if(old('Functional_status',$data['Functional_status'])==2 and old('Functional_status',$data['Functional_status'])!="") selected @endif  value="2"> working</option>
         <option @if(old('Functional_status',$data['Functional_status'])==0 and old('Functional_status',$data['Functional_status'])!="" ) selected @endif value="0">Out of work</option>
   </select>
      @error('Functional_status')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-12">
            <div class="form-group">
               <label>       Residence address inside Qatar </label>
               <input  type="text" name="qater_staies_address" id="qater_staies_address" class="form-control" value="{{ old('qater_staies_address',$data['qater_staies_address']) }}" >
               @error('qater_staies_address')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      
          <div class="col-md-12 " >
            <div class="form-group">
               <label> HR notes on driver </label>
               <textarea  type="text" name="driver_notes" id="notes" class="form-control" >
                  {{ old('driver_notes',$data['driver_notes']) }}

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
         <button class="btn btn-sm btn-success" type="submit" name="submit">Update Driver Data</button>
         <a href="{{ route('HumanResource.index') }}" class="btn btn-danger btn-sm">Cancel</a>
      </div>
   </div>
            
          
         </form>
      </div>
   
   
   </div>
</div>
 {{-- ======================================================================================================================= --}}
  {{-- ======================================================================================================================= --}}
<div class="modal fade  "   id="show_imageModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">     Show image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div align=center class="modal-body" id="show_imageModalBody"  style="background-color: white !important; color:black;">

            {{-- @if (pathinfo($data['visa_image'], PATHINFO_EXTENSION) == 'pdf') --}}
            <iframe  style=" width:700px;height: 500px;" id="show_imageModal_Image"  src=""></iframe><br/>
            {{-- <iframe  class="custom_img" id="show_imageModal_Image" src=""></iframe><br/> --}}
            {{-- <embed style=" width:700px;height: 500px;" id="show_imageModal_Image" src=""  alt="pdf" /><br/> --}}
            {{-- @else --}}
            {{-- <img style=" width:700px;height: 500px;" id="show_imageModal_Image"  src="" alt="الصورة الشخصية للسائق" ><br/> --}}
            {{-- @endif --}}
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
 if($(this).val()!=11 ){
$(".related_driver_residency_process_status").hide();
 }else{
   $(".related_driver_residency_process_status").show();

 }

   });


//   $(document).on('change','#driver_bank_process',function(e){
//  if($(this).val()!=10 ){
// $(".related_driver_bank_process").hide();
//  }else{
//   $(".related_driver_bank_process").show();

//  }

//   });

   
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
 }else{
   $(".related_appointment_type").show();

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


   $(document).on('change','#does_has_ateendance',function(e){
 if($(this).val()!=1 ){
$(".related_does_has_ateendance").hide();
 }else{
   $(".related_does_has_ateendance").show();

 }

   });
   
   
   

</script>
@endsection