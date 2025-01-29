@extends('layouts.admin')
@section('title')
Employee Data
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Employees.index') }}">     Staff</a>
@endsection
@section('contentheaderactive')
Update
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  New driver update
            <input type="hidden" id="Oldflats" value="{{$data['appartment_no']}}">

         </h3>
      </div>
      <div class="card-body">
         <form action="{{ route('Housing.update',$data['id']) }}" method="post" enctype="multipart/form-data">
            @csrf
      
   <!-- /.card -->
   <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title text-right" style="width: 100%;
        text-align: right !important;">
          <i class="fas fa-edit"></i>
          Driver Required Data
        </h3>
      </div>
      <div class="card-body">
      
        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">


          {{-- <li class="nav-item">
            <a class="nav-link active" id="personal_date" data-toggle="pill" href="#custom-content-personal_data" role="tab" aria-controls="custom-content-personal_data" aria-selected="true">بيانات شخصية</a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link active" id="sudan_data" data-toggle="pill" href="#custom-content-employee_sudan_data" role="tab" aria-controls="custom-content-employee_sudan_data" aria-selected="true">Driver Data </a>
          </li>

         
               
        </ul>

        {{-- ======================================================================================================================= --}}
        {{-- ======================================================================================================================= --}}
        <div class="tab-content" id="custom-content-below-tabContent">
          <div class="tab-pane fade show active" id="custom-content-employee_sudan_data" role="tabpanel" aria-labelledby="sudan_data">
            <br>
            <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label>    Driver's full name</label>
                  <input readonly type="text" name="driver_name" id="driver_name" class="form-control" value="{{ old('driver_name',$data['driver_name']) }}" >
                  @error('driver_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4">
            <div class="form-group">
               <label> Appointment type  </label>
               <select readonly name="appointment_type" id="appointment_type" class="form-control">
               <option   @if(old('appointment_type',$data['appointment_type'])==1) selected @endif  value="1">Coming from home country</option>
               <option   @if(old('appointment_type',$data['appointment_type'])==2) selected @endif  value="2">From within Qatar (internal)</option>
            </select>
               @error('appointment_type')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div>
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          <div class="col-md-4">
            <div class="form-group">
               <label>    Nationality   </label>
               <input readonly type="text" name="nationalities" id="nationalities" class="form-control" value="{{ old('nationalities',$data->Nationalities->name) }}" >
               @error('nationalities')
               <span class="text-danger">{{ $message }}</span> 
               @enderror
            </div>
         </div> 
          {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            {{-- <div class="col-md-4 " >
               <div class="form-group">
                  <label>   رقم جواز السفر  	</label>
                  <input readonly type="text" name="driver_pasport_no" id="driver_pasport_no" class="form-control" value="{{ old('driver_pasport_no',$data['driver_pasport_no']) }}" >
                  @error('driver_pasport_no')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div> --}}
            
           {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
           <div class="col-md-4">
            <div class="form-group">
               <label>   Driver's profile picture</label>
               @if ($data['driver_photo']!=null ||$data['driver_photo']!="")
                  <img class="custom_img" src="{{ asset('/../assets/admin/uploads').'/'.$data['driver_photo'] }}" alt="الصورة الشخصية للسائق" ><br/>
                  <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $data['driver_photo'] }}" style="width:150px;" value="initial_contract_image">Show</button>
                  @endif
            </div>
         </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}   
          
               <div class="col-md-4 " >
                  <div class="form-group">
                     <label>   Entry Qatar Date</label>
                     <input readonly type="date" name="arrive_qater_date" id="arrive_qater_date" class="form-control" value="{{ old('arrive_qater_date',$data['arrive_qater_date']) }}" >
                     @error('arrive_qater_date')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>       
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
            <div class="col-md-4">
               <div class="form-group">
                  <label>     Qatar phone number </label>
                  <input readonly type="text" name="driver_quater_tel" id="driver_quater_tel" class="form-control" value="{{ old('driver_quater_tel',$data['driver_quater_tel']) }}" >
                  @error('driver_quater_tel')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

            
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

            
            <div class="col-md-4">
               <div class="form-group">
            <label>       Building number </label>
                  <select  name="bulding" id="bulding" class="form-control select2 ">
                     <option  value="">Select the building </option>
                     @if (@isset($other['flats']) && !@empty($other['flats']))
                     @foreach ($other['flats'] as $info )
                     <option  value="{{ $info->bulding_no }}"> {{ $info->bulding_no }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('bulding')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>


             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

             <div class="col-md-4">
               <div class="form-group">
            <label>Apartment number</label>
                  <select readonly name="flats" id="flats" class="form-control select2 ">
                     <option  value="">Select the building first.  </option>
                  </select>
                  @error('flats')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>


    {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

    {{-- <div class="col-md-4">
      <div class="form-group">
         <label>   حالة الزي الرسمي   </label>
         <select  name="uniform_status" id="uniform_status" class="form-control">
         <option   @if(old('uniform_status',$data['uniform_status'])==0) selected @endif  value="0">لم يتم اي اجراء</option>
         <option   @if(old('uniform_status',$data['uniform_status'])==1) selected @endif  value="1">   تم قياس الزي الرسمي ولم يتم السليم     </option>
         <option @if(old('uniform_status',$data['uniform_status'])==2) selected @endif value="2"> تم تسليم الزي الرسمي للسائق </option>
      </select>
         @error('uniform_status')
         <span class="text-danger">{{ $message }}</span> 
         @enderror
      </div>
   </div> --}}
    {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}






         

         </div>

         </div>

          {{-- ======================================================================================================================= --}}
          {{-- ======================================================================================================================= --}}
         
             {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
          
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

       
     
      

       
      
         </div>
         </div>

           {{-- ======================================================================================================================= --}}
           {{-- ======================================================================================================================= --}}
          
     
        </div>
       
      </div>
      <!-- /.card -->
    </div>
    <!-- /.card -->


            

            <div class="col-md-12">
              <div class="form-group text-center"> 
                 <button class="btn btn-sm btn-success" type="submit" name="submit">Update Driver Data</button>
                 <a href="{{ route('Housing.index') }}" class="btn btn-danger btn-sm">Cancel</a>
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


   $(document).on('change','#country_id',function(e){
      get_governorates();
      });
   function get_governorates(){
   var country_id=$("#country_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_governorates') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',country_id:country_id},
   success: function(data){
   $("#governorates_Div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}

$(document).on('change','#governorates_id',function(e){
      get_centers();
      });
   function get_centers(){
   var governorates_id=$("#governorates_id").val();
   jQuery.ajax({
   url:'{{ route('Employees.get_centers') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',governorates_id:governorates_id},
   success: function(data){
   $("#centers_div").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}


   $(document).on('change','#bulding',function(e){
      get_flats();
      });
   function get_flats(){
   var old_flats_id = $("#Oldflats").val();
   var bulding_no=$("#bulding").val();
   jQuery.ajax({
   url:'{{ route('Housing.get_flats') }}',
   type:'post',
   'dataType':'html',
   cache:false,
   data:{"_token":'{{ csrf_token() }}',
   bulding_no:bulding_no,
   old_flats_id:old_flats_id},
   success: function(data){
   $("#flats").html(data);
   },
   error:function(){
   alert("عفوا لقد حدث خطأ ");
   }
   
   });
}



</script>
@endsection