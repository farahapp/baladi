@extends('layouts.admin')
@section('title')
طراز المركبة
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('VehicleModel.index') }}">   طراز  المركبة</a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة   طراز مركبة   
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('VehicleModel.store') }}" method="post">
            @csrf
      
            {{-- <div class="col-md-12">
               <div class="form-group">
                  <label>     نوع المركبة</label>
                  <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}

            <div class="col-md-12">
               <div class="form-group">
                   <label>   نوع المركبة </label>
                     <select name="vechile_type" id="vechile_type" class="form-control select2 ">
                        {{-- <option  value="">اختر نوع المركبة</option> --}}
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

            <div class="col-md-12">
               <div class="form-group">
                  <label>     طراز المركبة</label>
                  <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"  >
                  @error('name')
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
                  <button class="btn btn-sm btn-success" type="submit" name="submit">اضف طراز مركبة </button>
                  <a href="{{ route('VehicleModel.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection