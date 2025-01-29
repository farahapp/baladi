@extends('layouts.admin')
@section('title')
التسويق
@endsection
@section('contentheader')
التسويق  
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Marketing.index') }}">   التسويق   </a>
@endsection
@section('contentheaderactive')
تعديل
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  تعديل مقدم داخلي       
         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Marketing.update',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

            <div class="col-md-4">
               <div class="form-group">
                  <label>الإسم</label>
                  <input  type="text" name="name" id="name" class="form-control" value="{{ old('name',$data['name']) }}" placeholder="الإسم"  >
                  @error('name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

    
            <div class="col-md-4">
               <div class="form-group">
                  <label>      رقم الاقامة  </label>
                  <input  type="text" name="id_number" id="id_number" class="form-control" value="{{ old('id_number',$data['id_number']) }}" placeholder="رقم الاقامة"  >
                  @error('id_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            
            

            <div class="col-md-4">
               <div class="form-group">
                  <label>        العمر  </label>
                  <input  type="text" name="age" id="age" class="form-control" value="{{ old('age',$data['age']) }}" placeholder="العمر"  >
                  @error('age')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>        رقم الهاتف  </label>
                  <input  type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number',$data['phone_number']) }}" placeholder="رقم الهاتف"  >
                  @error('phone_number')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>


            <div class="col-md-4">
               <div class="form-group">
                  <label>    هل يمتلك رخصة قيادة سودانية</label>
                  <select   name="does_has_sudanese_Driving_License" id="does_has_sudanese_Driving_License" class="form-control">
                  <option @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==0 and old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])!="" ) selected @endif value="0">لا</option>
                  <option   @if(old('does_has_sudanese_Driving_License',$data['does_has_sudanese_Driving_License'])==1) selected @endif  value="1">نعم </option>
               </select>
                  @error('does_has_Driving_License')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>




      
            <div class="col-md-4">
               <div class="form-group">
                  <label>      تاريخ التسجيل   </label>
                  <input  type="date" name="registeration_date" id="registeration_date" class="form-control" value="{{ old('registeration_date',$data['registeration_date']) }}" placeholder="تاريخ التسجيل"  >
                  @error('registeration_date')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            <div class="col-md-12 " >
               <div class="form-group">
                  <label> ملاحظات علي مقدم الطلب </label>
                  <textarea type="text" name="notes" id="notes" class="form-control" >
                     {{ old('notes',$data['notes']) }}
   
                  </textarea>
                  @error('notes')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>




            <div class="col-md-12">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit">تعديل مقدم طلب  </button>
                  <a href="{{ route('Marketing.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>
            </div>
         </div>
      </form>
      </div>
   </div>
</div>
@endsection
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