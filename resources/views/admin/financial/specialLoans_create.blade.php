@extends('layouts.admin')
@section('title')
Employee Data
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.specialLoans_index') }}"> Request a loan</a>
@endsection
@section('contentheaderactive')
Request a loan 
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">  Request a loan    </h3>
   </div>
   <div class="card-body">
      @if(@isset($other) and !@empty($other))
      <form action="{{ route('financial.specialLoans_store') }}"  method="post" enctype="multipart/form-data" >
         <div class="row">
            @csrf
            <div class="col-md-12">
               <div class="form-group">
                  <label> Loan Name</label>
                  <input type="text" name="loan_name" id="loan_name" class="form-control" value="{{old('loan_name')  }}" placeholder="ادخل اسم القرض"    >
                  @error('loan_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group">
                  <label>Loan Amount </label>
                  <input type="text" name="loan_value" id="loan_value" class="form-control" value="{{old('loan_value')  }}" placeholder="ادخل قيمة القرض">
                  @error('loan_value')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

        

            <div class="col-md-4">
               <div class="form-group">
                  <label> applicant</label>
                  <select name="driver_id" id="driver_id" class="form-control select2 ">
                     <option value="empty">Select Applicant</option>
                     @if (@isset($other['employee']) && !@empty($other['employee']))
                     @foreach ($other['employee'] as $info )
                     <option @if(old('driver_id')==$info->id) selected="selected" @endif
                      value="{{ $info->id }}"> {{ $info->driver_name }} </option>
                     {{-- <input type="hidden"  id="driver_photo" value="{{$info->driver_photo}}">
                     <input type="hidden" id="isSigningInitialContract" value="{{$info->isSigningInitialContract}}">
                     <input type="hidden" id="isSigningMainContract" value="{{$info->isSigningMainContract}}">
                     <input type="hidden" id="isGivePassPort" value="{{$info->isGivePassPort}}">
                     <input type="hidden" id="isSigningFullFinancialDebt" value="{{$info->isSigningFullFinancialDebt}}">
                     <input type="hidden" id="isSigningPenaltyClause" value="{{$info->isSigningPenaltyClause}}"> --}}
                     @endforeach
                     @endif
                  </select>
                  @error('driver_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>

          


            {{-- <div class="col-md-4" id="custom_imgDiv" style="display: none;">
               <div class="form-group">
                  <label id="custom_img_label" name="custom_img_label">   الصورة الشخصية للسائق</label>
               </div >
                     <img id="custom_img" name="custom_img" class="custom_img" src="" alt="الصورة الشخصية للسائق" >
                     <button type="button" class="btn btn-sm btn-info showImageButton" style="width:150px;" value="initial_contract_image">عرض </button>
               </div>
            </div> --}}


    

            <div class="col-md-12">
               <div class="form-group">
                  <label>  Loan Status	</label>
                  <select  name="loan_status" id="loan_status" class="form-control">
                     <option   @if(old('loan_status')==0) selected @endif  value="0">Not approved  </option>
                     <option   @if(old('loan_status')==1) selected @endif  value="1">Approved</option>
                     <option   @if(old('loan_status')==2) selected @endif  value="2">The amount has been delivered.</option>
                     <option   @if(old('loan_status')==3) selected @endif  value="3"> The loan was declined.</option>
               </select>
                  @error('loan_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            
            <div class="col-md-4 "  >
               <div class="form-group">
                <label>Loan signature image  	</label>
            <input type="file" name="loan_image" id="loan_image" class="form-control" value="{{ old('loan_image') }}" >
            @error('loan_image')
            <span class="text-danger">{{ $message }}</span> 
            @enderror
         </div>
      </div>   
       
            <div class="col-md-12 text-center">
               <div class="form-group">
                  <button type="submit" id="addLoan" class="btn btn-success ">Add loan</button>
                  <a href="{{ route('financial.specialLoans_index') }}" class="btn btn-danger">Back</a>
               </div>
            </div>
         </div>
      </form>
      @else
      <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
      @endif
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

   $(document).on('change','#driver_id',function(e){
      var driver_photo=$("#driver_photo").val();



      var isSigningInitialContract=$("#isSigningInitialContract").val();
      var isSigningMainContract=$("#isSigningMainContract").val();
      var isGivePassPort=$("#isGivePassPort").val();
      var isSigningFullFinancialDebt=$("#isSigningFullFinancialDebt").val();
      var isSigningPenaltyClause=$("#isSigningPenaltyClause").val();

      if(isSigningInitialContract==0 ||
      isSigningMainContract==0 ||
      isGivePassPort==0 ||
      isSigningFullFinancialDebt==0 ||
      isSigningPenaltyClause==0
      ){
         $("#submitLabel").show();
         $("#addLoan").hide();
      }else{
         $("#submitLabel").hide();
         $("#addLoan").show();
      }




      if(driver_photo=='empty'){
         $("#custom_imgDiv").hide();
      }


                  //  alert(driver_photo);


var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+driver_photo;



$("#custom_img").attr("src",srcV);

$("#custom_imgDiv").show();



     
      });

      
   $(document).on('click','.showImageButton', function(e){


var driver_photo=$("#driver_photo").val();




var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+driver_photo;

    $("#show_imageModal_Image").attr("src",srcV);


    $("#show_imageModal").modal("show");


});



</script>
@endsection