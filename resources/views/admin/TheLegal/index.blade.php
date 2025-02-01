@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('TheLegal.index') }}">     الموظفين</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات  السائقين 
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('TheLegal.ajax_search')}}">
            <input type="hidden" id="ajax_update_isSigningInitialContract" value="{{route('TheLegal.ajax_update_isSigningInitialContract')}}">
            <input type="hidden" id="ajax_update_isGivePassPort" value="{{route('TheLegal.ajax_update_isGivePassPort')}}">
            <input type="hidden" id="ajax_update_isSigningMainContract" value="{{route('TheLegal.ajax_update_isSigningMainContract')}}">
            <input type="hidden" id="ajax_update_isSigningFullFinancialDebt" value="{{route('TheLegal.ajax_update_isSigningFullFinancialDebt')}}">
            <input type="hidden" id="ajax_update_isSigningPenaltyClause" value="{{route('TheLegal.ajax_update_isSigningPenaltyClause')}}">            
         </h3>
      </div>


      <div class="row">

         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="name"> بالإسم
            <input type="radio" name="searchbyradio" id="searchbyradio" value="id_number"> بالاقامة
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> بالهاتف
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> استلام الجواز  </label>
            <select  name="isGivePassPort" id="isGivePassPort" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يتم تسليم الجواز  </option>
            <option  value="1">   تم تسليم الجواز</option>
            </select>
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> توقيع العقد الرئيسي   </label>
            <select  name="isSigningMainContract" id="isSigningMainContract" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يتم توقيع المديونية   </option>
            <option  value="1">   تم توقيع المديونية </option>
            </select>
         </div>
      </div>


      
      <div class="col-md-3">
         <div class="form-group">
            <label> توقيع المديونية   </label>
            <select  name="isSigningFullFinancialDebt" id="isSigningFullFinancialDebt" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يتم توقيع المديونية   </option>
            <option  value="1">   تم توقيع المديونية </option>
            </select>
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> توقيع الشرط الجزائي   </label>
            <select  name="isSigningPenaltyClause" id="isSigningPenaltyClause" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يتم توقيع الشرط الجزائي   </option>
            <option  value="1">   تم توقيع الشرط الجزائي </option>
            </select>
         </div>
      </div>


      </div>



      <div class="card-body" id="the_legal_ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead" style="background-color: rgb(106, 32, 32)">
               <th>{{ __('mycustom.driver_name') }}</th>
               {{-- <th>{{ __('mycustom.driver_pasport_no') }}</th> --}}
               <th>{{ __('mycustom.signing_initial_contract') }}</th>
               <th>{{ __('mycustom.arrive_qater_date') }}</th>
               <th>{{ __('mycustom.give_passport') }}</th>
               <th>{{ __('mycustom.signing_main_contract') }}</th>
               <th>{{ __('mycustom.signing_full_financial_debt') }}</th>
               <th>{{ __('mycustom.signing_penalty_clause') }}</th>
               {{-- <th>{{ __('mycustom.driver_bank_process') }}</th> --}}

               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->driver_name }}</td>
                  {{-- <td>{{ $info->driver_pasport_no }}</td> --}}


             
                     {{-- <td 
                     @if ($info->isSigningInitialContract==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isSigningInitialContract==1) موقع @else غير موقع 
                     @endif
                     </td> --}}

                     <td
                     @if ($info->isGivePassPort!=1
                        ||$info->isSigningMainContract!=1
                        ||$info->isSigningFullFinancialDebt!=1
                        ||$info->isSigningPenaltyClause!=1) class="bg-danger"  @else class="text-success" @endif>
                           <select  name="isSigningInitialContract" id="isSigningInitialContract"  class="form-control select2 " driver_id_value="{{ $info->id }}">
                           <option   @if(old('isSigningInitialContract',$info->isSigningInitialContract)==0) selected @endif  value="0">غير موقع   </option>
                           <option   @if(old('isSigningInitialContract',$info->isSigningInitialContract)==1) selected @endif  value="1">   موقع </option>
                        </select>
                     </td>


                     <td 
                     @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
                     @endif
                     </td>

                     

                     {{-- <td 
                     @if ($info->isGivePassPort==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isGivePassPort==1) تم التسليم @else  لم يتم التسليم 
                     @endif
                     </td> --}}


                     <td
                     @if ($info->isGivePassPort!=1
                     ||$info->isSigningMainContract!=1
                     ||$info->isSigningFullFinancialDebt!=1
                     ||$info->isSigningPenaltyClause!=1) class="bg-danger"  @else class="text-success" @endif>
                        <select  name="isGivePassPort" id="isGivePassPort"  class="form-control select2 " driver_id_value="{{ $info->id }}">
                           <option   @if(old('isGivePassPort',$info->isGivePassPort)==0) selected @endif  value="0">لم يتم التسليم </option>
                           <option   @if(old('isGivePassPort',$info->isGivePassPort)==1) selected @endif  value="1">   تم التسليم</option>
                        </select>
                  </td>

                     {{-- <td 
                     @if ($info->isSigningMainContract==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isSigningMainContract==1) موقع @else غير موقع 
                     @endif
                     </td> --}}


                     <td
                     @if ($info->isGivePassPort!=1
                     ||$info->isSigningMainContract!=1
                     ||$info->isSigningFullFinancialDebt!=1
                     ||$info->isSigningPenaltyClause!=1) class="bg-danger"  @else class="text-success" @endif>
                        <select  name="isSigningMainContract" id="isSigningMainContract"  class="form-control select2 " driver_id_value="{{ $info->id }}">
                           <option   @if(old('isSigningMainContract',$info->isSigningMainContract)==0) selected @endif  value="0">غير موقع   </option>
                           <option   @if(old('isSigningMainContract',$info->isSigningMainContract)==1) selected @endif  value="1">   موقع </option>
                        </select>
                    </td>

                     {{-- <td 
                     @if ($info->isSigningFullFinancialDebt==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isSigningFullFinancialDebt==1) موقع @else غير موقع 
                     @endif
                     </td> --}}

                     <td
                     @if ($info->isGivePassPort!=1
                        ||$info->isSigningMainContract!=1
                        ||$info->isSigningFullFinancialDebt!=1
                        ||$info->isSigningPenaltyClause!=1) class="bg-danger"  @else class="text-success" @endif>
                        <select  name="isSigningFullFinancialDebt" id="isSigningFullFinancialDebt"  class="form-control select2 " driver_id_value="{{ $info->id }}">
                           <option   @if(old('isSigningFullFinancialDebt',$info->isSigningFullFinancialDebt)==0) selected @endif  value="0">غير موقع   </option>
                           <option   @if(old('isSigningFullFinancialDebt',$info->isSigningFullFinancialDebt)==1) selected @endif  value="1">  موقع </option>
                        </select>
                    </td>


                     {{-- <td 
                     @if ($info->isSigningPenaltyClause==1) class="text-success" @else class="text-danger"  @endif > @if ($info->isSigningPenaltyClause==1) موقع @else غير موقع 
                     @endif
                     </td> --}}


                     <td
                     @if ($info->isGivePassPort!=1
                        ||$info->isSigningMainContract!=1
                        ||$info->isSigningFullFinancialDebt!=1
                        ||$info->isSigningPenaltyClause!=1) class="bg-danger"  @else class="text-success" @endif>
                        <select  name="isSigningPenaltyClause" id="isSigningPenaltyClause"  class="form-control select2 " driver_id_value="{{ $info->id }}">
                           <option   @if(old('isSigningPenaltyClause',$info->isSigningPenaltyClause)==0) selected @endif  value="0">غير موقع  </option>
                           <option   @if(old('isSigningPenaltyClause',$info->isSigningPenaltyClause)==1) selected @endif  value="1">   موقع </option>
                        </select>
                    </td>



                     {{-- <td 
                     @if ($info->driver_bank_process==1) class="text-success" @else class="text-danger"  @endif > @if ($info->driver_bank_process==1) تمت الطباعة @else لم تتم الطباعة  
                     @endif
                     </td> --}}



               
                  <td>
                     <a  href="{{ route('TheLegal.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تحديث بيانات السائق</a>
                     {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
         <br>
         <div class="col-md-12 text-center">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
@section("script")
<script  src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('assets/admin/js/the_legal.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

   

   
   $(document).on('change','#isSigningInitialContract', function(e){
      var isSigningInitialContract = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var token_search = $("#token_search").val();
      var ajax_url = $("#ajax_update_isSigningInitialContract").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         isSigningInitialContract: isSigningInitialContract,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
});




$(document).on('change','#isGivePassPort', function(e){
      var isGivePassPort = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_isGivePassPort").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         isGivePassPort: isGivePassPort,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
});




$(document).on('change','#isSigningMainContract', function(e){
      var isSigningMainContract = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_isSigningMainContract").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         isSigningMainContract: isSigningMainContract,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
});



$(document).on('change','#isSigningFullFinancialDebt', function(e){
      var isSigningFullFinancialDebt = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_isSigningFullFinancialDebt").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         isSigningFullFinancialDebt: isSigningFullFinancialDebt,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
});



$(document).on('change','#isSigningPenaltyClause', function(e){
      var isSigningPenaltyClause = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_isSigningPenaltyClause").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         isSigningPenaltyClause: isSigningPenaltyClause,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
});



</script>
@endsection
