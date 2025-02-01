@extends('layouts.admin')
@section('title')
Employee Data
@endsection
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.specialLoans_index') }}"> Edit  </a>
@endsection
@section('contentheaderactive')
Loan request
@endsection
@section('content')
<div class="card">
   <div class="card-header">
      <h3 class="card-title card_title_center">  Update loan and advance data </h3>
   </div>
   <div class="card-body">
      @if(@isset($specialLoans) and !@empty($specialLoans))
      <form action="{{ route('financial.specialLoans_update',$specialLoans['id']) }}"  method="post" enctype="multipart/form-data" >
         <div class="row">
            @csrf


            <div class="col-md-12">
               <div class="form-group">
                  <label> Loan Name</label>
                  <input type="text" name="loan_name" id="loan_name" class="form-control" value="{{old('loan_name',$specialLoans['loan_name'])  }}" placeholder="ادخل اسم القرض"  
                  @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(35)==true) @else readonly @endif >
                  @error('loan_name')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>



            <div class="col-md-12">
               <div class="form-group">
                  <label>Loan value</label>
                  <input type="text" name="loan_value" id="loan_value" class="form-control" value="{{old('loan_value',$specialLoans['loan_value'])  }}" placeholder="ادخل قيمة القرض"
                  @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(35)==true) @else readonly @endif>
                  @error('loan_value')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

        

            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(35)==true)
            <div class="col-md-4">
               <div class="form-group">
                  <label>  applicant</label>
                  <select name="driver_id" id="driver_id" class="form-control select2 ">
                     <option value="empty">Select Applicant</option>
                     @if (@isset($other['employee']) && !@empty($other['employee']))
                     @foreach ($other['employee'] as $info )
                     <option @if(old('driver_id',$specialLoans['driver_id'])==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->driver_name }} </option>
                     @endforeach
                     @endif
                  </select>
                  @error('driver_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
               </div>
            </div>
            @else 
            <div class="col-md-12">
               <div class="form-group">
                  <label> applicant</label>
                  <input readonly type="text" name="driver_id" id="driver_id" class="form-control" value="{{old('driver_id',$specialLoans->Driver_id->driver_name)  }}" placeholder="ادخل قيمة القرض">
                  @error('driver_id')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>

             @endif


         
             @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(35)==true)
            <div class="col-md-12">
               <div class="form-group">
                  <label> Loan Status	</label>
                  <select  name="loan_status" id="loan_status" class="form-control">
                     <option   @if(old('loan_status',$specialLoans['loan_status'])==0) selected @endif  value="0">Not approved</option>
                     <option   @if(old('loan_status',$specialLoans['loan_status'])==1) selected @endif  value="1">Approved </option>
                     <option   @if(old('loan_status',$specialLoans['loan_status'])==2) selected @endif  value="2">The amount has been delivered.</option>
                     <option   @if(old('loan_status',$specialLoans['loan_status'])==3) selected @endif  value="3">The loan was declined.</option>
               </select>
                  @error('loan_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            @else 
            <div class="col-md-12">
               <div class="form-group">
                  <label> Loan Status	</label>
                  <input readonly type="text" name="loan_status" id="loan_status" class="form-control" 
                  @if(old('loan_status',$specialLoans['loan_status'])==0) value="Not approved"
                  @elseif (old('loan_status',$specialLoans['loan_status'])==1) value="Approved"
                  @elseif (old('loan_status',$specialLoans['loan_status'])==2) value="The amount has been delivered."
                  @elseif (old('loan_status',$specialLoans['loan_status'])==3) value="The loan was declined."    
                  @endif              
                 >
                  @error('loan_status')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
             @endif
            
           


             @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(35)==true)
               <div class="col-md-4 related_driver_residency_process_status" ">
                  <div class="form-group" id="loan_image_oldImage">
                     <label>Loan signature image</label><br/>
                     <div class="image">
                     @if ($specialLoans['loan_image']!=null ||$specialLoans['loan_image']!="")
                     <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$specialLoans['loan_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
                     <button type="button" class="btn btn-sm btn-info showImageButton"  value="{{ $specialLoans['loan_image'] }}" style="width:50px;" value="loan_image">عرض </button>
                     @endif
                     <button type="button" class="btn btn-sm btn-info" id="change_loan_image" style="width:100px;" value="loan_image" >Select image</button>
                     <button type="button" class="btn btn-sm btn-danger" style="display: none;" id="cancel_loan_image">Cancel </button>
                 </div>
                  {{-- <input  type="file" name="driver_photo" id="driver_photo" class="form-control" value="{{ old('driver_photo',$data['driver_photo']) }}" > --}}
                  @error('loan_image')
                  <span class="text-danger">{{ $message }}</span> 
                  @enderror
               </div>
            </div>
            @else 
            <label>Loan signature image	</label><br/>
            @if ($specialLoans['loan_image']!=null ||$specialLoans['loan_image']!="")
                     <img class="custom_img" src="{{ secure_asset('assets/admin/uploads').'/'.$specialLoans['loan_image'] }}" alt="الصورة الشخصية للسائق" ><br/>
                   @else
             @endif

             @endif




       
            <div class="col-md-12 text-center">
               <div class="form-group">
                  {{-- <label id="submitLabel" class="text-danger" 
                  @if ($info['isSigningInitialContract']!=1
                  || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                  ) @else  style="display: none" @endif>       غير مسموح بالبداء بأي اجراء حتي يتم توقيع جميع العقود والمديونيات   </label><br/> --}}
                  {{-- <button id="updateLoan" class="btn btn-success " type="submit" 
                  @if ($info['isSigningInitialContract']!=1
                  || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                  ) disabled  @endif >تحديث بيانات القرض</button> --}}
                  <button id="updateLoan" class="btn btn-success " type="submit">Update loan information</button>

                  <a href="{{ route('financial.specialLoans_index') }}" class="btn btn-danger">Back</a>
               </div>
            </div>
         </div>

         {{-- @endforeach
         @endif --}}
      </form>
      @else
      <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
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
<script src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   
   
   $(document).on('click','.showImageButton', function(e){
      // alert("");
  var maneUrl=$(this).attr("value");
var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+maneUrl;
    $("#show_imageModal_Image").attr("src",srcV);
    $("#show_imageModal").modal("show");
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
         $("#updateLoan").hide();
      }else{
         $("#submitLabel").hide();
         $("#updateLoan").show();
      }



      if(driver_photo=='empty'){
         $("#custom_imgDiv").hide();
      }


                  //  alert(driver_photo);


var srcV='{{ asset("assets/admin/uploads/") }}'+'/'+driver_photo;



$("#custom_img").attr("src",srcV);

$("#custom_imgDiv").show();



     
      });




</script>
@endsection