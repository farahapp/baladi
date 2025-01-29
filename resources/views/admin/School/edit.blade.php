@extends('layouts.admin')
@section('title')
المدرسة
@endsection
@section('contentheader')
بيانات إضافية  
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   المدرسة   </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل بيانات المدرسة     
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('School.update',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="col-md-4">
               <div class="form-group">
                  <label>      الإسم  </label>
                  <input readonly  type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name',$data['driver_name']) }}" placeholder="الإسم"  >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


          



            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ التسجيل في المدرسة   </label>
                  <input  type="date" name="driver_school_start_date" id="driver_school_start_date" class="form-control" value="{{ old('driver_school_start_date',$data['driver_school_start_date']) }}" placeholder="لون المركبة"  >
                  @error('driver_school_start_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ بداية تدريب الشارع    </label>
                  <input  type="date" name="driver_school_start_road_training_date" id="driver_school_start_road_training_date" class="form-control" value="{{ old('driver_school_start_road_training_date',$data['driver_school_start_road_training_date']) }}" placeholder="لون المركبة"  >
                  @error('driver_school_start_road_training_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ إمتحان الشارع    </label>
                  <input  type="date" name="driver_school_road_exam_date" id="driver_school_road_exam_date" class="form-control" value="{{ old('driver_school_road_exam_date',$data['driver_school_road_exam_date']) }}" placeholder="لون المركبة"  >
                  @error('driver_school_road_exam_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ إعادة إمتحان الشارع    </label>
                  <input  type="date" name="driver_school_road_re_exam_date" id="driver_school_road_re_exam_date" class="form-control" value="{{ old('driver_school_road_re_exam_date',$data['driver_school_road_re_exam_date']) }}" placeholder="لون المركبة"  >
                  @error('driver_school_road_re_exam_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ  طباعة الرخصة    </label>
                  <input  type="date" name="printing_licence_date" id="printing_licence_date" class="form-control" value="{{ old('printing_licence_date',$data['printing_licence_date']) }}" placeholder="لون المركبة"  >
                  @error('printing_licence_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
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
            </div>


            
            <div class="col-md-4 related_does_has_sudanese_Driving_License"  @if($data['does_has_sudanese_Driving_License']==0) style="display: none" @endif>
               <div class="form-group" id="sudanese_driving_license_Image_oldImage">
                  <label>     صورة الرخصة السودانية     </label>
                  <div class="image">
                     @if ($data['sudanese_driving_license_Image']!=null ||$data['sudanese_driving_license_Image']!="")

                     @if (pathinfo($data['sudanese_driving_license_Image'], PATHINFO_EXTENSION) == 'pdf')
                     <iframe  class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['sudanese_driving_license_Image'] }}"></iframe><br/>
                     @else
                     <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['sudanese_driving_license_Image'] }}" alt=" صورة توقيع اقرار تسليم الجواز " ><br/>
                     @endif
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['sudanese_driving_license_Image'] }}" style="width:50px;" value="sudanese_driving_license_Image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_sudanese_driving_license_Image" style="width:100px;" value="sudanese_driving_license_Image" >اختيار صورة</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_sudanese_driving_license_Image">الغاء </button>
                 </div>
                  @error('sudanese_driving_license_Image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            



            <div class="col-md-4 relatedDriving_school_status">
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

      





            <div class="col-md-12 " >
               <div class="form-group">
                  <label> ملاحظات السائق الخاصة بالمدرسة </label>
                  <textarea type="text" name="driver_school_notes" id="driver_school_notes" class="form-control" >
                     {{ old('driver_school_notes',$data['driver_school_notes']) }}
                  </textarea>
                  @error('driver_school_notes')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تعديل بيانات المدرسة  </button>
                  <a href="{{ route('School.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
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
{{-- //////////////////////////////////////////////////// --}}
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



</script>
@endsection

{{-- //////////////////////////////////////////////////// --}}