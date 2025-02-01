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
Add
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Add apartment 
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Housing.flatstore') }}" method="post"  enctype="multipart/form-data">
            @csrf
      
            <div class="col-md-12">
               <div class="form-group">
                  <label>     Apartment Number </label>
                  <input type="text" name="flat_No" id="flat_No" class="form-control" value="{{ old('flat_No') }}"  >
                  @error('flat_No')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>     Building number </label>
                  <input type="text" name="bulding_no" id="bulding_no" class="form-control" value="{{ old('bulding_no') }}"  >
                  @error('bulding_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>    Beds Number   </label>
                  <input type="text" name="bed_number" id="bed_number" class="form-control" value="{{ old('bed_number') }}"  >
                  @error('bed_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            
            <div class="col-md-12">
               <div class="form-group">
                  <label>    Electricity meter number   </label>
                  <input type="text" name="electrical_counter_number" id="electrical_counter_number" class="form-control" value="{{ old('electrical_counter_number') }}"  >
                  @error('electrical_counter_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            <div class="col-md-12">
               <div class="form-group">
                  <label>     Water meter number   </label>
                  <input type="text" name="water_counter_number" id="water_counter_number" class="form-control" value="{{ old('water_counter_number') }}"  >
                  @error('water_counter_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


       



      <div class="col-md-12">
         <div class="form-group" id="flat_image_oldImage">
            <label>     Apartment picture      </label>
            <div class="image">
               @if ($data['flat_image']!=null ||$data['flat_image']!="")
               <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$data['flat_image'] }}" alt="الصورة الشخصية للسائق" >
               @endif
               <button type="button" class="btn btn-sm btn-info" id="change_flat_image" value="flat_image">Select image</button>
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
            <option @if(old('active',$data['active'])==0 and old('active',$data['active'])!='') selected @endif value="0">Out of service</option>
            </select>
            @error('active')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>

            
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">Add apartment </button>
                  <a href="{{ route('Housing.flats') }}" class="btn btn-danger btn-sm">Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection