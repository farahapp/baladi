@extends('layouts.admin')
@section('title')
Complaints
@endsection
@section('contentheader')
Settings
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Quality.administrativeSendComplaintsCreate') }}">   Complaints</a>
@endsection
@section('contentheaderactive')
Add
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Add a complaint
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Quality.administrativeSendComplaintsStore') }}" method="post">
            @csrf
      
            <div class="col-md-12">
               <div class="form-group">
                  <label> Complaint Title </label>
                  <input type="text" name="complaint_title" id="complaint_title" class="form-control" value="{{ old('complaint_title') }}"  >
                  @error('complaint_title')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>



            <div class="col-md-12 " >
               <div class="form-group">
                  <label>     Complaint details</label>
                  <textarea type="text" name="complaint" id="complaint" class="form-control" >
                     {{ old('complaint') }}
   
                  </textarea>
                  @error('complaint')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
    

           


            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">Submit Complaint </button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection