@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection
@section('contentheader')
المستخدمين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admins_accounts.index') }}">    تعديل بيانات مستخدم  </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل بيانات مستخدم   
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('admins_accounts.update',$data['id']) }}" method="post">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label>     اسم المستخدم كاملا</label>
                  <input type="text" name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12">
               <div class="form-group">
                  <label>    البريد الالكترني    </label>
                  <input  type="email" name="email" id="username" class="form-control" value="{{ old('email',$data['email']) }}" >
                  @error('email')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12">
               <div class="form-group">
                  <label>    اسم المستخدم لتسجيل الدخول </label>
                  <input  type="text" name="username" id="username" class="form-control" value="{{ old('username',$data->username) }}" >
                  @error('username')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12" id="checkForUpdatePasswordDIV">
               <div class="form-group">
                  <label> هل تريد تحديث كلمة المرور </label>
                  <select name="checkForUpdatePassword" id="checkForUpdatePassword" class="form-control">
                  <option  @if(old('checkForUpdatePassword',$data['checkForUpdatePassword'])==0) selected @endif  value="0">لا</option>
                  <option @if(old('checkForUpdatePassword',$data['checkForUpdatePassword'])==1) selected @endif  value="1">نعم</option>
               </select>
               @error('checkForUpdatePassword')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
               </div>
            </div>



            <div class="col-md-12" id="PasswordDIV" @if(old('checkForUpdatePassword')==0)style="display: none;" @endif >
               <div class="form-group">
                  <label>    كلمة المرور  لتسجيل الدخول </label>
                  <input   type="password" name="password" id="password" class="form-control" value="" >
                  @error('password')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>




            <div class="col-md-12">
               <div class="form-group">
                   <label>   بيانات الأدوار  </label>
                     <select name="permission_roles_id" id="permission_roles_id" class="form-control select2 ">
                        <option  value="">اختر صلاحية الدور للمستخدم </option>
                        @if (@isset($Permission_rols) && !@empty($Permission_rols))
                        @foreach ($Permission_rols as $info )
                        <option @if(old('permission_roles_id',$data['permission_roles_id'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('permission_roles_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>            


               {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-12">
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
         </div>
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
             <div class="col-md-12 related_does_has_ateendance" " @if($data['does_has_ateendance']!=1) style="display: none" @endif>
               <div class="form-group">
                  <label>      رقم الموظف في جهاز البصمة </label>
                  <input  type="text" name="ateendance_device_no" id="ateendance_device_no" class="form-control" value="{{ old('ateendance_device_no',$data['ateendance_device_no']) }}" >
                  @error('ateendance_device_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}   
   

            <div class="col-md-12">
               <div class="form-group">
                  <label> حالة التفعيل</label>
                  <select name="active" id="active" class="form-control">
                  <option @if(old('active',$data['active'])==1) selected @endif  value="1">مفعل</option>
                  <option  @if(old('active',$data['active'])==0) selected @endif  value="0">معطل</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تعديل قائمة فرعية </button>
                  <a href="{{ route('admins_accounts.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="{{ secure_asset('assets/admin/js/admins.js') }}"></script>

<script>

   $(document).on('change','#does_has_ateendance',function(e){
    if($(this).val()!=1 ){
   $(".related_does_has_ateendance").hide();
    }else{
      $(".related_does_has_ateendance").show();
   
    }
   
      });
      
   
   </script>

@endsection
