@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection
@section('contentheader')
صلاحيات القوائم الفرعية
@endsection
@section('contentheaderactivelink')
<a href="{{ route('permission_sub_menues.index') }}">   القوائم الفرعية  </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة قوائم فرعية للصلاحيات     
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('permission_sub_menues.store') }}" method="post">
            @csrf
      
            <div class="col-md-12">
               <div class="form-group">
                  <label>     اسم القائمة الفرعية</label>
                  <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="أدخل  الدور"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-12">
               <div class="form-group">
                   <label>   القائمة الرئيسية </label>
                     <select name="permission_main_menues_id" id="permission_main_menues_id" class="form-control select2 ">
                        <option  value="">اختر القائمة الرئيسية</option>
                        @if (@isset($data['Permission_main_menuesData']) && !@empty($data['Permission_main_menuesData']))
                        @foreach ($data['Permission_main_menuesData'] as $info )
                        <option @if(old('permission_main_menues_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                        @endforeach
                        @endif
                     </select>
                     @error('permission_main_menues_id')
                     <span class="text-danger">{{ $message }}</span>
                     @enderror
               </div>
            </div>
    

            <div class="col-md-12">
               <div class="form-group">
                  <label> حالة التفعيل</label>
                  <select  name="active" id="active" class="form-control">
                  <option   @if(old('active')==1) selected @endif  value="1">مفعل</option>
                  <option @if(old('active')==0 and old('active')!='') selected @endif value="0">معطل</option>
                  </select>
                  @error('active')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف القائمة الفرعية </button>
                  <a href="{{ route('permission_sub_menues.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection