@extends('layouts.admin')
@section('title')
الصيانة
@endsection
@section('contentheader')
الدراجات النارية  
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index_bike') }}">   الدراجات النارية   </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل بيانات دراجة نارية     
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Maintenance.update_bike',$data['Vechile_Information']['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="col-md-4">
               <div class="form-group">
                  <label>      رقم اللوحة </label>
                  <input  type="text" name="vechile_no" id="vechile_no" class="form-control" value="{{ old('vechile_no',$data['Vechile_Information']['vechile_no']) }}" placeholder="رقم اللوحة  "  >
                  @error('vechile_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label> فرع الشركة</label>
                  <select name="branches" id="branches  " class="form-control select2 ">
                     <option  value="">اختر فرع الشركة</option>
                     @if (@isset($data['branches']) && !@empty($data['branches']))
                     @foreach ($data['branches'] as $info )
                     <option @if(old('branches',$data['Vechile_Information']['branches'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('branches')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>



            <div class="col-md-4">
               <div class="form-group">
                   <label>   نوع الدراجة النارية </label>
                     <select name="vechile_type" id="vechile_type" class="form-control select2 ">
                        <option  value="">اختر نوع الدراجة النارية</option>
                        @if (@isset($data['Vechile_Type']) && !@empty($data['Vechile_Type']))
                        @foreach ($data['Vechile_Type'] as $info )
                        <option @if(old('vechile_type',$data['Vechile_Information']['vechile_type'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('vechile_type')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                   <label>   طراز الدراجة النارية </label>
                     <select name="vechile_model" id="vechile_model" class="form-control select2 ">
                        <option  value="">اختر نوع الدراجة النارية</option>
                        @if (@isset($data['Vechile_Model']) && !@empty($data['Vechile_Model']))
                        @foreach ($data['Vechile_Model'] as $info )
                        <option @if(old('vechile_model',$data['Vechile_Information']['vechile_model'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('vechile_model')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>
    
            <div class="col-md-4">
               <div class="form-group">
                  <label>      لون الدراجة النارية  </label>
                  <input  type="text" name="vechile_color" id="vechile_color" class="form-control" value="{{ old('vechile_color',$data['Vechile_Information']['vechile_color']) }}" placeholder="لون الدراجة النارية"  >
                  @error('vechile_color')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ إنتهاء الترخيص  </label>
                  <input  type="date" name="vechile_end_registeration" id="vechile_end_registeration" class="form-control" value="{{ old('vechile_end_registeration',$data['Vechile_Information']['vechile_end_registeration']) }}" placeholder="لون الدراجة النارية"  >
                  @error('vechile_end_registeration')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            

            <div class="col-md-4">
               <div class="form-group">
                  <label>       شركة التأمين  </label>
                  <input  type="text" name="insurance_company" id="insurance_company" class="form-control" value="{{ old('insurance_company',$data['Vechile_Information']['insurance_company']) }}" placeholder="شركة التأمين"  >
                  @error('insurance_company')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>       انتهاء التأمين  </label>
                  <input  type="date" name="insurance_ending_date" id="insurance_ending_date" class="form-control" value="{{ old('insurance_ending_date',$data['Vechile_Information']['insurance_ending_date']) }}" placeholder="انتهاء التأمين"  >
                  @error('insurance_ending_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label> نوع التأمين</label>
                  <select  name="insurance_type" id="insurance_type" class="form-control">
                  <option   @if(old('insurance_type',$data['Vechile_Information']['insurance_type'])==1) selected @endif  value="1">ضد الغير</option>
                  <option @if(old('insurance_type',$data['Vechile_Information']['insurance_type'])==0 and old('insurance_type',$data['Vechile_Information']['insurance_type'])!='') selected @endif value="0">شامل</option>
                  </select>
                  @error('insurance_type')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                   <label>   سائق الدراجة النارية </label>
                     <select name="vechile_driver" id="vechile_driver" class="form-control select2 ">
                        <option  value="">اختار سائق الدراجة النارية</option>
                        @if (@isset($data['Employee']) && !@empty($data['Employee']))
                        @foreach ($data['Employee'] as $info )
                        <option @if(old('vechile_driver',$data['Vechile_Information']['vechile_driver'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->driver_name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('vechile_driver')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>


            {{-- <div class="col-md-4">
               <div class="form-group">
            <label>     صورة ترخيص الدراجة النارية     </label>
            <input type="file" name="vechile_registeration_image" id="vechile_registeration_image" class="form-control" value="{{ old('vechile_registeration_image',$data['Vechile_Information']['vechile_registeration_image']) }}" >
            @error('vechile_registeration_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>    --}}

      <div class="col-md-4">
         <div class="form-group" id="vechile_registeration_image_oldImage">
            <label>     صورة ترخيص الدراجة النارية     </label>
            <div class="image">
               @if ($data['Vechile_Information']['vechile_registeration_image'] !=null ||$data['Vechile_Information']['vechile_registeration_image'] !="")
               <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['Vechile_Information']['vechile_registeration_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
               <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ old('vechile_registeration_image',$data['Vechile_Information']['vechile_registeration_image']) }}"  style="width:50px;" value="initial_contract_image">عرض </button>
               @endif
               <button type="button" class="btn btn-sm btn-info" id="change_vechile_registeration_image" style="width:100px;" value="vechile_registeration_image">إختيار صورة</button>
               <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_vechile_registeration_image">الغاء </button>
           </div>
            @error('vechile_registeration_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

      {{-- <div class="col-md-4">
         <div class="form-group">
      <label>     صورة الدراجة النارية      </label>
      <input type="file" name="vechile_image" id="vechile_image" class="form-control" value="{{ old('vechile_image',$data['Vechile_Information']['vechile_image']) }}" >
      @error('vechile_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>    --}}

<div class="col-md-4">
   <div class="form-group" id="vechile_image_oldImage">
      <label>     صورة الدراجة النارية      </label>
      <div class="image">
         @if ($data['Vechile_Information']['vechile_image'] !=null ||$data['Vechile_Information']['vechile_image'] !="")
         <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['Vechile_Information']['vechile_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
         <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ old('vechile_image',$data['Vechile_Information']['vechile_image']) }}"  style="width:50px;" value="initial_contract_image">عرض </button>
         @endif
         <button type="button" class="btn btn-sm btn-info" id="change_vechile_image" style="width:100px;" value="vechile_image">إختيار صورة</button>
         <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_vechile_image">الغاء </button>
     </div>
      @error('vechile_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>


      
            <div class="col-md-4">
               <div class="form-group">
                  <label> حالة الدراجة النارية</label>
                  <select  name="vechile_status" id="vechile_status" class="form-control">
                  <option   @if(old('vechile_status')==1) selected @endif  value="1">تعمل</option>
                  <option @if(old('vechile_status',$data['Vechile_Information']['vechile_status'])==0 and old('vechile_status',$data['Vechile_Information']['vechile_status'])!='') selected @endif value="0">متعطلة </option>
                  <option @if(old('vechile_status',$data['Vechile_Information']['vechile_status'])==2 and old('vechile_status',$data['Vechile_Information']['vechile_status'])!='') selected @endif value="2">  داخل الصيانة</option>
                  </select>
                  @error('vechile_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12 " >
               <div class="form-group">
                  <label> ملاحظات علي الصيانة </label>
                  <textarea type="text" name="maintenance_notes" id="maintenance_notes" class="form-control" >
                     {{ old('maintenance_notes',$data['Vechile_Information']['maintenance_notes']) }}
   
                  </textarea>
                  @error('maintenance_notes')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تعديل بيانات الدراجة النارية  </button>
                  <a href="{{ route('Maintenance.index') }}" class="btn btn-danger btn-sm">الغاء</a>
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