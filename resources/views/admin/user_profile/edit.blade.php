@extends('layouts.admin')
@section('title')
Profile 
@endsection
@section('contentheader')
Users
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admins_accounts.index') }}">  Profile   </a>
@endsection
@section('contentheaderactive')
Edit
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center"> Edit profile data   
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('userProfile.update') }}" method="post">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label>     Full username</label>
                  <input readonly type="text" name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12">
               <div class="form-group">
                  <label>    Email  </label>
                  <input  type="email" name="email" id="username" class="form-control" value="{{ old('email',$data['email']) }}" >
                  @error('email')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12">
               <div class="form-group">
                  <label>    Username to login </label>
                  <input  type="text" name="username" id="username" class="form-control" value="{{ old('username',$data->username) }}" >
                  @error('username')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12" id="checkForUpdatePasswordDIV">
               <div class="form-group">
                  <label> Do you want to update your password? </label>
                  <select name="checkForUpdatePassword" id="checkForUpdatePassword" class="form-control">
                  <option  @if(old('checkForUpdatePassword',$data['checkForUpdatePassword'])==0) selected @endif  value="0">No</option>
                  <option @if(old('checkForUpdatePassword',$data['checkForUpdatePassword'])==1) selected @endif  value="1">Yes</option>
               </select>
               @error('checkForUpdatePassword')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
               </div>
            </div>



            <div class="col-md-12" id="PasswordDIV" @if(old('checkForUpdatePassword')==0)style="display: none;" @endif >
               <div class="form-group">
                  <label>    Password </label>
                  <input   type="password" name="password" id="password" class="form-control" value="" >
                  @error('password')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>



      
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-info" type="submit" name="submit">Save update   </button>
                  <a href="{{ route('userProfile.index') }}" class="btn btn-danger btn-sm">Cancel</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/admin/js/admins.js') }}"></script>
@endsection
