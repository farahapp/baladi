@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
         <h3 class="card-title card_title_center">  تحديث  سائق جديد
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('TheLegal.update',$data['id']) }}" method="post" enctype="multipart/form-data">
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
               <select readonly name="appointment_type" id="appointment_type" class="form-control">
               <option   @if(old('appointment_type',$data['appointment_type'])==1) selected @endif  value="1">قادم من البلد الام</option>
               <option   @if(old('appointment_type',$data['appointment_type'])==2) selected @endif  value="2">من داخل قطر (داخلي)</option>
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
                  <select readonly name="contract_type" id="contract_type" class="form-control">
                  <option   @if(old('contract_type',$data['contract_type'])==1) selected @endif  value="1">عقد دائم (ثلاث سنوات)  </option>
                  <option   @if(old('contract_type',$data['contract_type'])==2) selected @endif  value="2">ينتهي بفسخ العقد   (6 شهور)</option>
               </select>
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
                  <select readonly name="driver_gender" id="driver_gender" class="form-control">
                  <option   @if(old('driver_gender',$data['driver_gender'])==1) selected @endif  value="1">ذكر</option>
                  <option @if(old('driver_gender',$data['driver_gender'])==2 ) selected @endif value="2">انثي</option>
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
                  <select  name="isSigningInitialContract" id="isSigningInitialContract" class="form-control">
                  <option   @if(old('isSigningInitialContract',$data['isSigningInitialContract'])==0) selected @endif  value="0">لم يتم توقيع العقد المبدئي   </option>
                  <option   @if(old('isSigningInitialContract',$data['isSigningInitialContract'])==1) selected @endif  value="1">   تم توقيع العقد المبدئي </option>
               </select>
                  @error('MotivationType')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            
                {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
                

         {{-- <div class="col-md-4 relatedisSigningInitialContract" " @if ($data['isSigningInitialContract']==0) style="display: none" @endif >
            <div class="form-group" id="initial_contract_image_oldImage">
               <label>     صورة توقيع العقد المبدئي    </label>
               <div class="image">
                  @if ($data['initial_contract_image']!=null ||$data['initial_contract_image']!="")
                  <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['initial_contract_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['initial_contract_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
                  @endif 
                  <button type="button" class="btn btn-sm btn-info" id="change_initial_contract_image" style="width:100px;" value="initial_contract_image">إختيار صورة</button>
                  <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_initial_contract_image">الغاء </button>

              </div>
               @error('initial_contract_image')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div> --}}


         
   <div class="col-md-4 relatedisSigningInitialContract" " @if($data['isSigningInitialContract']==0) style="display: none" @endif >
      <div class="form-group" id="initial_contract_image_oldImage">
         <label>     صورة توقيع العقد المبدئي    </label>
         <div class="image">
            @if ($data['initial_contract_image']!=null ||$data['initial_contract_image']!="")
   
            @if (pathinfo($data['initial_contract_image'], PATHINFO_EXTENSION) == 'pdf')
            <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['initial_contract_image'] }}"></iframe><br/>
            @else
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['initial_contract_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            @endif
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['initial_contract_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_initial_contract_image" style="width:100px;" value="give_passport_image" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_initial_contract_image">الغاء </button>
        </div>
         @error('initial_contract_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>

         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4">
            <div class="form-group">
               <label>   الصورة الشخصية للسائق</label>
               @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                  <img class="custom_img"  id="showImageView"  src="{{ secure_asset('assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">عرض الصورة</button>
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

                  <div class="col-md-4">
                     <div class="form-group">
                  <label>       اجراءات البنك واصدار دفتر الشيكات  </label>
                        <select readonly name="driver_bank_process" id="driver_bank_process" class="form-control select2 ">
                           <option  value="">اختر حالة البنك</option>
                           @if (@isset($other['nationalities']) && !@empty($other['nationalities']))
                           @foreach ($other['nationalities'] as $info )
                           <option @if(old('driver_bank_process',$data['driver_bank_process'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                           @endforeach
                           @endif
                        </select>
                        @error('driver_bank_process')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                     </div>
                  </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

                  {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label> استلام الجواز  </label>
                  <select  name="isGivePassPort" id="isGivePassPort" class="form-control">
                  <option   @if(old('isGivePassPort',$data['isGivePassPort'])==0) selected @endif  value="0">لم يتم تسليم الجواز  </option>
                  <option   @if(old('isGivePassPort',$data['isGivePassPort'])==1) selected @endif  value="1">   تم تسليم الجواز</option>
               </select>
                  @error('isGivePassPort')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
        
      {{-- <div class="col-md-4 relatedisGivePassPort" " @if ($data['isGivePassPort']==0) style="display: none" @endif>
         <div class="form-group" id="give_passport_image_oldImage">
            <label>     صورة توقيع اقرار تسليم الجواز   </label>
            <div class="image">
               @if ($data['give_passport_image']!=null ||$data['give_passport_image']!="")
               <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['give_passport_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
               <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['give_passport_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
               @endif
               <button type="button" class="btn btn-sm btn-info" id="change_give_passport_image" style="width:100px;" value="give_passport_image" >اختيار صورة</button>
               <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_give_passport_image">الغاء </button>
           </div>
            @error('give_passport_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}


      
   <div class="col-md-4 relatedisGivePassPort" " @if($data['isGivePassPort']==0) style="display: none" @endif >
      <div class="form-group" id="give_passport_image_oldImage">
         <label>     صورة توقيع اقرار تسليم الجواز   </label>
         <div class="image">
            @if ($data['give_passport_image']!=null ||$data['give_passport_image']!="")
   
            @if (pathinfo($data['give_passport_image'], PATHINFO_EXTENSION) == 'pdf')
            <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['give_passport_image'] }}"></iframe><br/>
            @else
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['give_passport_image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            @endif
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['give_passport_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_give_passport_image" style="width:100px;" value="give_passport_image" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_give_passport_image">الغاء </button>
        </div>
         @error('give_passport_image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>

       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
    <div class="col-md-4">
      <div class="form-group">
         <label> توقيع العقد الرئيسي   </label>
         <select  name="isSigningMainContract" id="isSigningMainContract" class="form-control">
         <option   @if(old('isSigningMainContract',$data['isSigningMainContract'])==0) selected @endif  value="0">لم يتم توقيع المديونية   </option>
         <option   @if(old('isSigningMainContract',$data['isSigningMainContract'])==1) selected @endif  value="1">   تم توقيع المديونية </option>
      </select>
         @error('isSigningMainContract')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>
    {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   {{-- <div class="col-md-4 relatedisSigningMainContract" " @if ($data['isSigningMainContract']==0) style="display: none" @endif>
      <div class="form-group" id="isSigningMainContractImage_oldImage">
         <label>     صورة توقيع العقد  الرئيسي    </label>
         <div class="image">
            @if ($data['isSigningMainContractImage']!=null ||$data['isSigningMainContractImage']!="")
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningMainContractImage'] }}" alt="صورة توقيع العقد  الرئيسي" ><br/>
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningMainContractImage'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_isSigningMainContractImage" style="width:100px;" value="isSigningMainContractImage" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningMainContractImage">الغاء </button>
        </div>
         @error('isSigningMainContractImage')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div> --}}



   <div class="col-md-4 relatedisSigningMainContract" " @if($data['isSigningMainContract']==0) style="display: none" @endif >
      <div class="form-group" id="isSigningMainContractImage_oldImage">
         <label>     صورة توقيع العقد  الرئيسي    </label>
         <div class="image">
            @if ($data['isSigningMainContractImage']!=null ||$data['isSigningMainContractImage']!="")
   
            @if (pathinfo($data['isSigningMainContractImage'], PATHINFO_EXTENSION) == 'pdf')
            <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningMainContractImage'] }}"></iframe><br/>
            @else
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningMainContractImage'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            @endif
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningMainContractImage'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_isSigningMainContractImage" style="width:100px;" value="isSigningMainContractImage" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningMainContractImage">الغاء </button>
        </div>
         @error('isSigningMainContractImage')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>



      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

      <div class="col-md-4">
         <div class="form-group">
            <label> توقيع المديونية   </label>
            <select  name="isSigningFullFinancialDebt" id="isSigningFullFinancialDebt" class="form-control">
            <option   @if(old('isSigningFullFinancialDebt',$data['isSigningFullFinancialDebt'])==0) selected @endif  value="0">لم يتم توقيع المديونية   </option>
            <option   @if(old('isSigningFullFinancialDebt',$data['isSigningFullFinancialDebt'])==1) selected @endif  value="1">   تم توقيع المديونية </option>
         </select>
            @error('isSigningFullFinancialDebt')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

      

 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

      {{-- <div class="col-md-4 relatedisSigningFullFinancialDebt" " @if ($data['isSigningFullFinancialDebt']==0)  style="display: none" @endif >
         <div class="form-group" id="SigningFullFinancialDebt_Image_oldImage">
            <label>     صورة توقيع المديونية    </label>
            <div class="image">
               @if ($data['SigningFullFinancialDebt_Image']!=null ||$data['SigningFullFinancialDebt_Image']!="")
               <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebt_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
               <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['SigningFullFinancialDebt_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
               @endif
               <button type="button" class="btn btn-sm btn-info" id="change_SigningFullFinancialDebt_Image" style="width:100px;" value="SigningFullFinancialDebt_Image" >اختيار صورة</button>
               <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_SigningFullFinancialDebt_Image">الغاء </button>
           </div>
            @error('SigningFullFinancialDebt_Image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div> --}}


      <div class="col-md-4 relatedisSigningFullFinancialDebt" " @if($data['isSigningFullFinancialDebt']==0) style="display: none" @endif >
         <div class="form-group" id="isSigningPenaltyClause_Image_oldImage">
            <label>     صورة توقيع المديونية    </label>
            <div class="image">
               @if ($data['SigningFullFinancialDebt_Image']!=null ||$data['SigningFullFinancialDebt_Image']!="")
      
               @if (pathinfo($data['SigningFullFinancialDebt_Image'], PATHINFO_EXTENSION) == 'pdf')
               <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebt_Image'] }}"></iframe><br/>
               @else
               <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebt_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
               @endif
               <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['SigningFullFinancialDebt_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
               @endif
               <button type="button" class="btn btn-sm btn-info" id="change_SigningFullFinancialDebt_Image" style="width:100px;" value="SigningFullFinancialDebt_Image" >اختيار صورة</button>
               <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_SigningFullFinancialDebt_Image">الغاء </button>
           </div>
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
                  <option   @if(old('isSigningPenaltyClause',$data['isSigningPenaltyClause'])==0) selected @endif  value="0">لم يتم توقيع الشرط الجزائي   </option>
                  <option   @if(old('isSigningPenaltyClause',$data['isSigningPenaltyClause'])==1) selected @endif  value="1">   تم توقيع الشرط الجزائي </option>
               </select>
                  @error('isSigningPenaltyClause')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

             {{-- <div class="col-md-4 relatedisSigningPenaltyClause" " @if ($data['isSigningPenaltyClause']==0)  style="display: none" @endif >
               <div class="form-group" id="isSigningPenaltyClause_Image_oldImage">
                  <label>     صورة توقيع الشرط الجزائي    </label>
                  <div class="image">
                     @if ($data['isSigningPenaltyClause_Image']!=null ||$data['isSigningPenaltyClause_Image']!="")
                     <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClause_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningPenaltyClause_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_isSigningPenaltyClause_Image" style="width:100px;" value="isSigningPenaltyClause_Image" >اختيار صورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningPenaltyClause_Image">الغاء </button>
                 </div>
                  @error('isSigningPenaltyClause_Image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}


            <div class="col-md-4 relatedisSigningPenaltyClause" " @if($data['isSigningPenaltyClause']==0) style="display: none" @endif >
               <div class="form-group" id="isSigningPenaltyClause_Image_oldImage">
                  <label>     صورة توقيع الشرط الجزائي    </label>
                  <div class="image">
                     @if ($data['isSigningPenaltyClause_Image']!=null ||$data['isSigningPenaltyClause_Image']!="")
            
                     @if (pathinfo($data['isSigningPenaltyClause_Image'], PATHINFO_EXTENSION) == 'pdf')
                     <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClause_Image'] }}"></iframe><br/>
                     @else
                     <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClause_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                     @endif
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningPenaltyClause_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_isSigningPenaltyClause_Image" style="width:100px;" value="isSigningPenaltyClause_Image" >اختيار صورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningPenaltyClause_Image">الغاء </button>
                 </div>
                  @error('isSigningPenaltyClause_Image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

      
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
   {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

   <div class="col-md-4">
      <div class="form-group">
         <label> توقيع  شيك المديونية   </label>
         <select  name="isSigningFullFinancialDebtCheck" id="isSigningFullFinancialDebtCheck" class="form-control">
            <option   @if(old('isSigningFullFinancialDebtCheck',$data['isSigningFullFinancialDebtCheck'])==0) selected @endif  value="0">لم يتم توقيع شيك المديونية   </option>
            <option   @if(old('isSigningFullFinancialDebtCheck',$data['isSigningFullFinancialDebtCheck'])==1) selected @endif  value="1">   تم توقيع  شيك المديونية </option>
         </select>
            @error('isSigningFullFinancialDebtCheck')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

    {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

    {{-- <div class="col-md-4 relatedisSigningFullFinancialDebtCheck" " @if ($data['isSigningFullFinancialDebtCheck']==0)  style="display: none" @endif >
      <div class="form-group" id="SigningFullFinancialDebtCheck_Image_oldImage">
         <label>     صورة توقيع شيك المديونية    </label>
         <div class="image">
            @if ($data['SigningFullFinancialDebtCheck_Image']!=null ||$data['SigningFullFinancialDebtCheck_Image']!="")
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebtCheck_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['SigningFullFinancialDebtCheck_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_SigningFullFinancialDebtCheck_Image" style="width:100px;" value="SigningFullFinancialDebt_Image" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_SigningFullFinancialDebtCheck_Image">الغاء </button>
        </div>
         @error('SigningFullFinancialDebtCheck_Image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div> --}}


   <div class="col-md-4 relatedisSigningFullFinancialDebtCheck" " @if($data['isSigningFullFinancialDebtCheck']==0) style="display: none" @endif >
      <div class="form-group" id="SigningFullFinancialDebtCheck_Image_oldImage">
         <label>     صورة توقيع شيك المديونية    </label>
         <div class="image">
            @if ($data['SigningFullFinancialDebtCheck_Image']!=null ||$data['SigningFullFinancialDebtCheck_Image']!="")
   
            @if (pathinfo($data['SigningFullFinancialDebtCheck_Image'], PATHINFO_EXTENSION) == 'pdf')
            <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebtCheck_Image'] }}"></iframe><br/>
            @else
            <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['SigningFullFinancialDebtCheck_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
            @endif
            <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['SigningFullFinancialDebtCheck_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
            @endif
            <button type="button" class="btn btn-sm btn-info" id="change_SigningFullFinancialDebtCheck_Image" style="width:100px;" value="SigningFullFinancialDebtCheck_Image" >اختيار صورة</button>
            <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_SigningFullFinancialDebtCheck_Image">الغاء </button>
        </div>
         @error('SigningFullFinancialDebtCheck_Image')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div>
   


{{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

 <div class="col-md-4">
   <div class="form-group">
      <label> توقيع  شيك الشرط الجزائي   </label>
      <select  name="isSigningPenaltyClauseCheck" id="isSigningPenaltyClauseCheck" class="form-control">
      <option   @if(old('isSigningPenaltyClauseCheck',$data['isSigningPenaltyClauseCheck'])==0) selected @endif  value="0">لم يتم توقيع شيك الشرط الجزائي   </option>
      <option   @if(old('isSigningPenaltyClauseCheck',$data['isSigningPenaltyClauseCheck'])==1) selected @endif  value="1">   تم توقيع شيك الشرط الجزائي </option>
   </select>
      @error('isSigningPenaltyClauseCheck')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

 {{-- <div class="col-md-4 relatedisSigningPenaltyClauseCheck" " @if ($data['isSigningPenaltyClauseCheck']==0)  style="display: none" @endif >
   <div class="form-group" id="isSigningPenaltyClauseCheck_Image_oldImage">
      <label>     صورة توقيع شيك الشرط الجزائي    </label>
      <div class="image">
         @if ($data['isSigningPenaltyClauseCheck_Image']!=null ||$data['isSigningPenaltyClauseCheck_Image']!="")
         <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClauseCheck_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
         <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningPenaltyClauseCheck_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
         @endif
         <button type="button" class="btn btn-sm btn-info" id="change_isSigningPenaltyClauseCheck_Image" style="width:100px;" value="isSigningPenaltyClauseCheck_Image" >اختيار صورة</button>
         <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningPenaltyClauseCheck_Image">الغاء </button>
     </div>
      @error('isSigningPenaltyClauseCheck_Image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div> --}}


<div class="col-md-4 relatedisSigningPenaltyClauseCheck" " @if($data['isSigningPenaltyClauseCheck']==0) style="display: none" @endif >
   <div class="form-group" id="isSigningPenaltyClauseCheck_Image_oldImage">
      <label>     صورة توقيع شيك الشرط الجزائي    </label>
      <div class="image">
         @if ($data['isSigningPenaltyClauseCheck_Image']!=null ||$data['isSigningPenaltyClauseCheck_Image']!="")

         @if (pathinfo($data['isSigningPenaltyClauseCheck_Image'], PATHINFO_EXTENSION) == 'pdf')
         <iframe  class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClauseCheck_Image'] }}"></iframe><br/>
         @else
         <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['isSigningPenaltyClauseCheck_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
         @endif
         <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['isSigningPenaltyClauseCheck_Image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
         @endif
         <button type="button" class="btn btn-sm btn-info" id="change_isSigningPenaltyClauseCheck_Image" style="width:100px;" value="isSigningPenaltyClauseCheck_Image" >اختيار صورة</button>
         <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_isSigningPenaltyClauseCheck_Image">الغاء </button>
     </div>
      @error('isSigningPenaltyClauseCheck_Image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>


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
                  <button class="btn btn-sm btn-success" type="submit" name="submit" >تحديث بيانات السائق </button>
                  <a href="{{ route('TheLegal.index') }}" class="btn btn-danger btn-sm">الغاء</a>
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
</script>
@endsection