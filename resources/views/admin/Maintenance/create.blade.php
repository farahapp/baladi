@extends('layouts.admin')
@section('title')
Maintenance
@endsection
@section('contentheader')
Cars  
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   Cars   </a>
@endsection
@section('contentheaderactive')
Add
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Add a car       
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Maintenance.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="col-md-4">
               <div class="form-group">
                  <label>      Plate number </label>
                  <input  type="text" name="vechile_no" id="vechile_no" class="form-control" value="{{ old('vechile_no') }}" placeholder="رقم اللوحة  "  >
                  @error('vechile_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>



             {{-- <div class="col-md-4">
               <div class="form-group">
                  <label> فرع الشركة</label>
                  <select name="branches" id="branches  " class="form-control select2 ">
                     <option  value="">اختر فرع الشركة</option>
                     @if (@isset($data['branches']) && !@empty($data['branches']))
                     @foreach ($data['branches'] as $info )
                     <option @if(old('branches')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('branches')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div> --}}


            <div class="col-md-4">
               <div class="form-group">
                   <label>   Vehicle Type </label>
                     <select name="vechile_type" id="vechile_type" class="form-control select2 ">
                        <option  value="">Select vehicle type</option>
                        @if (@isset($data['Vechile_Type']) && !@empty($data['Vechile_Type']))
                        @foreach ($data['Vechile_Type'] as $info )
                        <option @if(old('vechile_type')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
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
                   <label>   Vehicle Model </label>
                     <select name="vechile_model" id="vechile_model" class="form-control select2 ">
                        <option  value="">Select vehicle model</option>
                        @if (@isset($data['Vechile_Model']) && !@empty($data['Vechile_Model']))
                        @foreach ($data['Vechile_Model'] as $info )
                        <option @if(old('vechile_model')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
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
                  <label>    vehicle color   </label>
                  <input  type="text" name="vechile_color" id="vechile_color" class="form-control" value="{{ old('vechile_color') }}" placeholder="لون المركبة"  >
                  @error('vechile_color')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>  Vehicle license expiry date </label>
                  <input  type="date" name="vechile_end_registeration" id="vechile_end_registeration" class="form-control" value="{{ old('vechile_end_registeration') }}" placeholder="لون المركبة"  >
                  @error('vechile_end_registeration')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            

            <div class="col-md-4">
               <div class="form-group">
                  <label>      Insurance company  </label>
                  <input  type="text" name="insurance_company" id="insurance_company" class="form-control" value="{{ old('insurance_company') }}" placeholder="شركة التأمين"  >
                  @error('insurance_company')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>      Vehicle insurance expiry date  </label>
                  <input  type="date" name="insurance_ending_date" id="insurance_ending_date" class="form-control" value="{{ old('insurance_ending_date') }}" placeholder="انتهاء التأمين"  >
                  @error('insurance_ending_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label> insurance type</label>
                  <select  name="insurance_type" id="insurance_type" class="form-control">
                  <option   @if(old('insurance_type')==1) selected @endif  value="1">Third party insurance</option>
                  <option @if(old('insurance_type')==0 and old('insurance_type')!='') selected @endif value="0">Comprehensive insurance</option>
                  </select>
                  @error('insurance_type')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                   <label>   Vehicle driver </label>
                     <select name="vechile_driver" id="vechile_driver" class="form-control select2 ">
                        <option  value="">Select the vehicle driver</option>
                        @if (@isset($data['Employee']) && !@empty($data['Employee']))
                        @foreach ($data['Employee'] as $info )
                        <option @if(old('vechile_driver')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->driver_name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('vechile_driver')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
            <label>     Vehicle license photo    </label>
            <input type="file" name="vechile_registeration_image" id="vechile_registeration_image" class="form-control" value="{{ old('vechile_registeration_image') }}" >
            @error('vechile_registeration_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>   


      <div class="col-md-4">
         <div class="form-group">
      <label>     Vehicle Image      </label>
      <input type="file" name="vechile_image" id="vechile_image" class="form-control" value="{{ old('vechile_image') }}" >
      @error('vechile_image')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>   


      
            <div class="col-md-4">
               <div class="form-group">
                  <label> Vehicle condition</label>
                  <select  name="vechile_status" id="vechile_status" class="form-control">
                  <option   @if(old('vechile_status')==1) selected @endif  value="1">running</option>
                  <option @if(old('vechile_status')==0 and old('vechile_status')!='') selected @endif value="0">broken down</option>
                  <option @if(old('vechile_status')==2 and old('vechile_status')!='') selected @endif value="2">  in maintenance</option>
                  </select>
                  @error('vechile_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12 " >
               <div class="form-group">
                  <label> Car notes </label>
                  <textarea type="text" name="maintenance_notes" id="maintenance_notes" class="form-control" >
                     {{ old('maintenance_notes') }}
   
                  </textarea>
                  @error('maintenance_notes')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>




            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">Add car</button>
                  <a href="{{ route('Maintenance.index') }}" class="btn btn-danger btn-sm">Cancel</a>
               </div>
            </div>
         </div>
      </form>
      </div>
   </div>
</div>
@endsection
@section("script")
<script src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
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