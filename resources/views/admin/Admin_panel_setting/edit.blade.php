@extends('layouts.admin')
@section('title')
الضبط العام للنظام
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admin_panel_settings.edit') }}"> تعديل الضبط العام</a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">  تحديث بيانات الضبط العام للنظام </h3>
   </div>
   <div class="card-body">
      @if(@isset($data) and !@empty($data))
      <form action="{{ route('admin_panel_settings.update') }}" >
         <div class="row">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label>اسم الشركة</label>
                  <input type="text" name="company_name" id="company_name" class="form-control" value="{{old('company_name',$data['company_name'])  }}"    >
                  @error('company_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>هاتف الشركة</label>
                  <input type="text" name="phones" id="phones" class="form-control" value="{{old('phones',$data['phones'])  }}" placeholder="ادخل اسم الشركة">
                  @error('phones')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label> عنوان الشركة	</label>
                  <input type="text" name="address" id="address" class="form-control" value="{{old('address',$data['address'])  }}" placeholder="ادخل عنوان الشركة">
                  @error('phones')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>بريد الشركة	</label>
                  <input type="text" name="email" id="email" class="form-control" value="{{old('email',$data['email'])  }}" placeholder="ادخل بريد الشركة">
                  @error('phones')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
       
            <div class="col-md-12 text-center">
               <div class="form-group">
                  <button type="submit" class="btn btn-success ">تحديث</button>
               </div>
            </div>
         </div>
      </form>
      @else
      <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
      @endif
   </div>
</div>
@endsection