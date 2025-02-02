@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
قائمة  التشغيل
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     إدارة التشغيل</a>
@endsection
@section('contentheaderactive')
تحديث
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تحديث  بيانات التشغيل 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Operation.update',$data['id']) }}" method="post" enctype="multipart/form-data">
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
               <label>        تاريخ الميلاد</label>
               <input readonly type="date" data-date="" data-date-format="DD MMMM YYYY" name="brith_date" id="brith_date" class="form-control" value="{{ old('brith_date',$data['brith_date']) }}" >
               @error('brith_date')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
     
                 {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-4">
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
 

        {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-4">
            <div class="form-group">
                  <label>  نوع الديلفري</label>
                  <select   name="delevery_type" id="delevery_type" class="form-control">
                  <option   @if(old('delevery_type',$data['delevery_type'])==1) selected @endif  value="1">سائق سيارة</option>
                  <option @if(old('delevery_type',$data['delevery_type'])==2 ) selected @endif value="2">سائق دراجة نارية</option>
                  </select>
                  @error('delevery_type')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
         {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}


             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
             <div class="col-md-4">
               <div class="form-group">
                  <label>        نوع المركبة</label>
                  @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
                  <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data->Driver_vechile->vechile_car_or_bike) }}" >
                  @error('brith_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
                  @else
                  <br/>
                  لايوجد 
                  @endif
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
     
          
              {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
              <div class="col-md-4">
               <div class="form-group">
                  <label>        موديل المركبة</label>
                  @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
                  <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data->Driver_vechile->vechile_model) }}" >
                  @error('brith_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
                  @else
               <br/>
                  لايوجد 
                  @endif
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////البحث عن طريق حالة المركبة////////////////////////////////////////////////////// --}}
        
     

         <div class="col-md-4">
            <div class="form-group">
                  <label>  نوع العقد </label>
            <select   name="operating_contract_type" id="operating_contract_type" class="form-control">
               <option   @if(old('operating_contract_type',$data['operating_contract_type'])=="") selected @endif  value=""> إختر نوع العقد</option>
               <option   @if(old('operating_contract_type',$data['operating_contract_type'])==1 and old('operating_contract_type',$data['operating_contract_type'])!="") selected @endif  value="1">عقد حر</option>
               <option   @if(old('operating_contract_type',$data['operating_contract_type'])==2 and old('operating_contract_type',$data['operating_contract_type'])!="") selected @endif  value="2">800 ريال</option>
             </select>
             @error('delevery_type')
             <span class="text-danger">{{ $message }}</span> 
             @enderror
          </div>
       </div>

         <div class="col-md-4">
            <div class="form-group">
                  <label>  المشغل </label>
            <select   name="operating_company" id="operating_company" class="form-control">
               <option   @if(old('operating_company',$data['operating_company'])=="") selected @endif  value=""> إختر المشغل</option>
               <option   @if(old('operating_company',$data['operating_company'])==1 and old('operating_company',$data['operating_company'])!="") selected @endif  value="1"> Baladi</option>
               <option   @if(old('operating_company',$data['operating_company'])==2 and old('operating_company',$data['operating_company'])!="") selected @endif  value="2"> External operating company</option>
             </select>
             @error('delevery_type')
             <span class="text-danger">{{ $message }}</span> 
             @enderror
          </div>
       </div>


       <div class="col-md-4 related_operating_company_talabat"
        @if($data['operating_company']!='1')style="display: none" @endif >
         <div class="form-group">
            <label>     رقم  طلبات </label>
            <input  type="text" name="operating_talabat_no" id="operating_talabat_no" class="form-control" value="{{ old('operating_talabat_no',$data['operating_talabat_no']) }}" >
            @error('operating_talabat_no')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

      <div class="col-md-4 related_operating_company_talabat"
      @if($data['operating_company']!='1')style="display: none" @endif>
         <div class="form-group">
               <label>  تقييم درجات طلبات </label>
         <select   name="operating_talabat_rate" id="operating_talabat_rate" class="form-control">
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])=="") selected @endif  value=""> إختر تقيم طلبات</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="6"> الدرجة السادسة</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="5"> الدرجة الخامسة</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="4"> الدرجة الرابعة</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="3"> الدرجة الثالثة</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="2"> الدرجة الثانية</option>
            <option   @if(old('operating_talabat_rate',$data['operating_talabat_rate'])==1 and old('operating_talabat_rate',$data['operating_talabat_rate'])!="") selected @endif  value="1"> الدرجة الأولى</option>
          </select>
          @error('delevery_type')
          <span class="text-danger">{{ $message }}</span> 
          @enderror
       </div>
    </div>



      <div class="col-md-4 related_operating_company_snono"
      @if($data['operating_company']!='2')style="display: none" @endif>
         <div class="form-group">
            <label>     رقم سنونو  </label>
            <input  type="text" name="operating_snono_no" id="operating_snono_no" class="form-control" value="{{ old('operating_snono_no',$data['operating_snono_no']) }}" >
            @error('operating_snono_no')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>


          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}              
          <div class="col-md-4">
            <div class="form-group">
               <label>        تاريخ بداية العمل</label>
               <input  type="date" data-date="" data-date-format="DD MMMM YYYY" name="operating_starting_work_date" id="operating_starting_work_date" class="form-control" value="{{ old('operating_starting_work_date',$data['operating_starting_work_date']) }}" >
               @error('brith_date')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-4">
         <div class="form-group">
               <label>  حالة العمل التشغيلية </label>
         <select   name="operating_working_status" id="operating_working_status" class="form-control">
            <option   @if(old('operating_working_status',$data['operating_working_status'])=="") selected @endif  value=""> إختر حالة العمل</option>
            <option   @if(old('operating_working_status',$data['operating_working_status'])==0 and old('operating_working_status',$data['operating_working_status'])!="") selected @endif  value="0"> لايعمل</option>
            <option   @if(old('operating_working_status',$data['operating_working_status'])==1 and old('operating_working_status',$data['operating_working_status'])!="") selected @endif  value="1"> يعمل</option>
            <option   @if(old('operating_working_status',$data['operating_working_status'])==2 and old('operating_working_status',$data['operating_working_status'])!="") selected @endif  value="2"> إجازة</option>
          </select>
          @error('operating_working_status')
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
                 <a href="{{ route('Operation.index') }}" class="btn btn-danger btn-sm">الغاء</a>
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






  
   $(document).on('change','#operating_company',function(e){
 if($(this).val()==1){
$(".related_operating_company_talabat").show();
$(".related_operating_company_snono").hide();
 }else if($(this).val()==2){
   $(".related_operating_company_snono").show();
   $(".related_operating_company_talabat").hide();
 }else{
   $(".related_operating_company_talabat").hide();
   $(".related_operating_company_snono").hide();
 }
   });



 


</script>
@endsection