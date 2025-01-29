@extends('layouts.admin')
@section('title')
Guard
@endsection
@section('contentheader')
Guard 
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('SecurityGuard_Receive.index') }}">     Drivers</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  Drivers Information   
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_update_report_status" value="{{route('uniform.ajax_update_report_status')}}">
            <input type="hidden" id="ajax_search_url" value="{{route('uniform.ajax_daily_report_search')}}">
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
               <input checked type="radio" name="searchbyradio" id="searchbyradio" value="baladi_id"> Baladi Id
            <input  type="radio" name="searchbyradio" value="name"> Name
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> Phone
            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

     

     
      
     

    


      </div>



      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ asset('/../assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         {{-- <table id="example2" class="table table-bordered table-hover"> --}}
            <main class="table">
               {{-- <section class="table__header">
                  Drivers Uniform
               </section> --}}
               <section class="table__body">
                  <table>
                     <thead>
                        <tr>
                        <th>No  </th>
                        <th>{{ __('mycustom.driver_name') }}</th>
                        <th>Image</th>
                        <th>{{ __('mycustom.driver_baladi_id') }}</th>
                        <th>{{ __('mycustom.nationalty') }}</th>
                        <th>Uniforms Status</th>
                        {{-- <th></th> --}}
                     </tr>
                     </thead>
                     <tbody>
                        @foreach ( $data as $info )
                        <tr>
                           <td>{{ (($data->firstItem() + $loop->index))  }}</td>
                           {{-- للترتيب التنازلي نستخدم الدالة التحت
                           <td>{{ $data->firstItem() + ($data->count() - $loop->index)}}</td>  --}}
                           <td>{{ $info->driver_name }}</td>
                           {{-- <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}" width="50" class="img-thumbnail rounded-circle"></td> --}}
                           <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}"></td>
                           <td>{{ $info->baladi_id }}</td>
         
                           <td><strong>{{ $info->Nationalities->name }}</strong></td>
         
                      
            
                              {{-- <td> 
                                 @foreach ( $driversUniform as $driversUniformVal )
                                 @if( $driversUniformVal->driver_id ==  $info->id )
                                 <p class="bg-danger text-center"> old order not returend</p>
                                  @break --}}

                                 {{-- @else
                                 <p class="bg-success text-center"> all order returend</p> --}}
                                 {{-- @endif
                                 @endforeach
                              </td> --}}


                              <td> 
                                 @foreach ( $driversUniform as $driversUniformVal )
                                 @if( $driversUniformVal->driver_id ==  $info->id )
                                @if ($driversUniformVal->report_status!=1)
                                <p class="bg-danger text-center"> old order not returend</p>
                                @break
                                {{-- @else
                                <p class="bg-success text-center"> all order returend</p> --}}
                                {{-- @break --}}

                                @endif
                                 @endif
                                 @endforeach
                              </td>
         
         
         
                        
                           {{-- <td>
                              <a  href="{{ route('SecurityGuard.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Add Uniform</a>
                           </td> --}}
                        </tr>

                        <tr>
                           <td colspan="7">
         
                              {{-- <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
                                 <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
                              </p> --}}
                              
                              @foreach ( $driversUniform as $driversUniformVal )
         
                              @if(@isset($driversUniform) and !@empty($driversUniform) and $driversUniformVal['driver_id'] ==  $info->id )
                              {{-- <main class="table"> --}}
                                 <section class="table__body">
                              <table>
                              <thead style="color:brown">
                                 <th>     Uniform Date </th>
                                 <th>     Uniform Time </th>
                                 <th>     Uniform status   </th>
                              </thead>
                              <tbody>
                        
                                 {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                                 <tr>
                                    <td style="color: brown;">{{ $driversUniformVal->date }}</td>

                                    {{-- <td style="color: brown;">{{ $driversUniformVal->created_at }}</td> --}}
      
                                    <td>
                                       @php
                                       $dt=new DateTime($driversUniformVal->created_at);
                                       $date=$dt->format("Y-m-d");
                                       $time=$dt->format("h:i");
                                       $newDateTime=date("A",strtotime($driversUniformVal->created_at));
                                       $newDateTimeType= (($newDateTime=='AM')?'AM ':'PM'); 
                                       @endphp
                                       {{-- {{ $date }} <br> --}}
                                       {{ $time }}
                                       {{ $newDateTimeType }}  <br>
                                    </td>


                                    {{-- <td 
                                    @if ($driversUniformVal->report_status==1) class="text-success" @else class="text-danger"  @endif >
                                    @if ($driversUniformVal->report_status==1) Returned Uniform 
                                    @elseif ($driversUniformVal->report_status==0) Returned Uniform 
                                    @endif --}}
      
                                    
                                    {{-- <td>{{ $driversUniformVal->report_status }}</td> --}}


                                    <td> 
                                       <select    name="report_status" id="report_status" report_id_value="{{ $driversUniformVal->id }}" class="form-control">
                                       <option  @if(old('report_status',$driversUniformVal->report_status)==0) selected  @endif  value="0">Not Returned Uniform </option>
                                       <option @if(old('report_status',$driversUniformVal->report_status)==1) selected @endif  value="1">Returned Uniform</option>
                                       </select>
                                    </td> 
                                    
                                 </tr>

                                   {{---------------------------------------------}}
                     <tr>
                        <td  colspan="5" style="text-align: center">
                        @foreach ($driversUniformItems as $UniformItem )
                        @if (@isset($driversUniformItems) && !@empty($driversUniformItems)  &&  $UniformItem->daily_employees_report_id == $driversUniformVal->id )
                        <a class="btn btn-sm " style="background-color: #EF4C2B;color:white">{{"(".$UniformItem->amount.")".$UniformItem->name."(".$UniformItem->size.")" }}<i class="fa fa-trash " aria-hidden="true"></i></a>
                        @endif
                        @endforeach
                     </td>
                     </tr>
                        {{---------------------------------------------}}
         
                              </tr>
                                
         
                              </tbody>
                           </table>
                        </section>
                     {{-- </main> --}}

                           @else
                           {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
                           @endif
                           @endforeach
         
                              </td>
                              </tr>
         



                        @endforeach

                     </tbody>
                  </table>
                  
               </section>
            </main>


            
         <br>
         <div class="col-md-12 text-center">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
         @endif
      </div>
   </div>
</div>
@endsection
@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
{{-- <script src="{{ asset('/../assets/admin/js/security_guard.js') }}"></script> --}}
<script src="{{ asset('/../assets/admin/js/show_unform_drivers.js') }}"></script>

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

$(document).on('change','#report_status', function(e){
   var report_status = $(this).val();
   var report_id_value=$(this).attr("report_id_value");
var token_search = $("#token_search").val();
 var ajax_url = $("#ajax_update_report_status").val();
jQuery.ajax({
     url: ajax_url,
     type: 'post',
     dataType: 'html',
     cache: false,
     data: {
      report_status: report_status,
      report_id_value: report_id_value,
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
