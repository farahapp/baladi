@extends('layouts.admin')
@section('title')
housing
@endsection
@section('contentheader')
Housing List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('departements.index') }}">   Apartments</a>
@endsection
@section('contentheaderactive')
Edit
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">   Edit apartment 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Housing.flatsupdate',$data['id']) }}" method="post"  enctype="multipart/form-data">
            @csrf
      
            <div class="col-md-12">
               <div class="form-group">
                  <label>     Apartment Number  </label>
                  <input readonly type="text" name="flat_No" id="flat_No" class="form-control" value="{{ old('flat_No',$data['flat_No']) }}"  >
                  @error('flat_No')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>     Building number  </label>
                  <input readonly type="text" name="bulding_no" id="bulding_no" class="form-control" value="{{ old('bulding_no',$data['bulding_no']) }}"  >
                  @error('bulding_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>      Beds Number   </label>
                  <input type="text" name="bed_number" id="bed_number" class="form-control" value="{{ old('bed_number',$data['bed_number']) }}"  >
                  @error('bed_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            
            <div class="col-md-12">
               <div class="form-group">
                  <label>     Electricity meter number     </label>
                  <input readonly type="text" name="electrical_counter_number" id="electrical_counter_number" class="form-control" value="{{ old('electrical_counter_number',$data['electrical_counter_number']) }}"  >
                  @error('electrical_counter_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>     Water meter number   </label>
                  <input readonly type="text" name="water_counter_number" id="water_counter_number" class="form-control" value="{{ old('water_counter_number',$data['water_counter_number']) }}"  >
                  @error('water_counter_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group">
                  <label>      Number of people   </label>
                  <input  type="text" name="driver_number" id="driver_number" class="form-control" value="{{ old('driver_number',$data['driver_number']) }}"  >
                  @error('driver_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

           

            <div class="col-md-12">
               <div class="form-group">
                  <label>        Apartment Rating    </label>
                  <select  name="flat_range" id="flat_range" class="form-control">
                  <option   @if(old('flat_range',$data['flat_range'])==1) selected @endif  value="1">excellent</option>
                  <option @if(old('flat_range',$data['flat_range'])==2 ) selected @endif value="2">very good</option>
                  <option @if(old('flat_range',$data['flat_range'])==3 ) selected @endif value="3">acceptable</option>
                  <option @if(old('flat_range',$data['flat_range'])==4 ) selected @endif value="4">bad</option>
                  <option @if(old('flat_range',$data['flat_range'])==5 ) selected @endif value="5">Very bad</option>
                  </select>
                  @error('flat_range')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group" id="flat_image_oldImage">
                  <label>     Apartment picture      </label>
                  <div class="image">
                     @if ($data['flat_image']!=null ||$data['flat_image']!="")
                     <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['flat_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['flat_image'] }}" style="width:50px;" value="initial_contract_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_flat_image" style="width:100px;" value="flat_image">Select image </button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_flat_image">Cancel </button>
                 </div>
                 

                  @error('flat_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
     


            


            <div class="col-md-12">
               <div class="form-group">
                  <label> Apartment Status</label>
                  <select  name="active" id="active" class="form-control">
                  <option   @if(old('active',$data['active'])==1) selected @endif  value="1">Ready</option>
                  <option @if(old('active',$data['active'])==0 and old('active',$data['active'])!='') selected @endif value="0">Out of service </option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>



            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit"> Apartment update </button>
                  <a href="{{ route('Housing.flats') }}" class="btn btn-danger btn-sm">Cancel</a>
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

</script>
@endsection