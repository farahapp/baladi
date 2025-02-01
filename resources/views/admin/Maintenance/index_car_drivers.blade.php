@extends('layouts.admin')
@section('title')
Drivers data
@endsection
@section('contentheader')
Drivers List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">{{ __('mycustom.drivers') }}</a>
@endsection
@section('contentheaderactive')
show
@endsection

@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  {{ __('mycustom.drivers_information') }}   

      
         </h3>
      </div>

      <form method="POST" action="{{ route('Operation.print_operation_index') }}" target="_blank">
         @csrf

         <input type="hidden" id="token_search" value="{{csrf_token()}}">
         <input type="hidden" id="ajax_search_url" value="{{route('Operation.ajax_search')}}">
         <input type="hidden" id="ajax_update_operating_contract_type" value="{{route('Operation.ajax_update_operating_contract_type')}}">
         <input type="hidden" id="ajax_update_operating_company" value="{{route('Operation.ajax_update_operating_company')}}">


      
      <div class="row" style="padding: 5px;">

         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> Vehicle driver
            <input type="radio" name="searchbyradio" id="searchbyradio"  value="vechile_no"> Plate number
            <input  autofocus style="margin-top 6px !important;" type="text" name="search_by_text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle type </label>
            <select  name="vechile_car_or_bike_search" id="vechile_car_or_bike_search" class="form-control">
            <option  value="all">All </option>
            <option  value="1">Car</option>
            <option  value="2">Bike</option>
            </select>
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle model </label>
            <select name="vechile_model_search" id="vechile_model_search" class="form-control select2 ">
               <option  value="all">All </option>
               @if (@isset($Vechile_Model) && !@empty($Vechile_Model))
               @foreach ($Vechile_Model as $info)
               <option value="{{ $info->id }}"> {{$info->name}} </option>
               @endforeach
               @endif
            </select>
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> Search by vehicle status </label>
            <select  name="vechile_status_search" id="vechile_status_search" class="form-control">
            <option  value="all"> All </option>
            <option  value="1">running</option>
            <option  value="0">broken down</option>
            <option  value="2">in maintenance</option>
            </select>
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> Search by operating company  </label>
            <select  name="operating_company_search" id="operating_company_search" class="form-control">
               <option  value="all">All</option>
               <option  value="1">Baladi</option>
               <option  value="2">External operating company</option>
            </select>
         </div>
      </div>

      {{-- <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق نوع العقد   </label>
            <select  name="operating_contract_type_search" id="operating_contract_type_search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="1">عقد حر</option>
            <option  value="2">800 ريال</option>
            </select>
         </div>
      </div> --}}

      <div class="col-md-2">
         <div class="form-group">
            <label> .</label></br>
            <button type="post" class="btn btn-sm btn-info custom_button">Print the search</button>
         </div>
      </div>


        

      </div>
   </form>



      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>No </th>
               <th>{{ __('mycustom.driver_name') }}</th>
               <th>Vehicle Type</th>
               <th>Vehicle Model</th>
               <th>Nationality</th>
               {{-- <th>نوع العقد</th> --}}
               <th>Operating Company</th>
               <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ (($data->firstItem() + $loop->index))  }}</td>
                  <td>{{ $info->driver_name }}</td>
                  <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
                     @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
                     
                     @if ($info->Driver_vechile->vechile_car_or_bike==1) Car  @else Bike    
                     @endif

                     {{-- {{ $info->Driver_vechile->vechile_car_or_bike }} --}}

                     @else
                     nothing 
                     @endif
                     </td>
                  {{-- @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile) and $other['vechile_model'][$info->Driver_vechile->vechile_model]['id'] ==  $info->Driver_vechile->vechile_model ) --}}
                  <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
                   @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
                   {{ $other['vechile_model'][$info->Driver_vechile->vechile_model-1]['name'] }}
                  {{-- @if (@isset($info->Driver_vechile->vechile_model) && !@empty($info->Driver_vechile->vechile_model)) --}}
                  {{-- @php --}}
                  {{-- // $array = App\Vechile_Model::Select(id)->get(); --}}
                 {{-- //   $value = App\Vechile_Model::select("id")->where($id,"=",$info->Driver_vechile->vechile_model)->first()  --}}
                  {{-- @endphp --}}
                  @else
                  لايوجد 
                  @endif
                  </td>


                  <td>{{ $info->Nationalities->name }}</td>

                  {{-- <td>{{ $info->driver_residency_permit_id }}</td> --}}

                  {{-- $other['vechile_information'] --}}


                     {{-- <td 
                     @if ($info->appointment_type==1) class="text-success" @else class="text-warning"  @endif > @if ($info->appointment_type==1) قادم من البلد الام  @else من داخل قطر (داخلي)    
                     @endif
                     </td> --}}

                     {{-- <td>
                        <select   name="operating_contract_type" id="operating_contract_type" driver_id_value="{{ $info->id }}" class="form-control">
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])=="") selected @endif  value=""> إختر نوع العقد</option>
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])==1 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="1">عقد حر</option>
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])==2 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="2">800 ريال</option>
                         </select>
                     </td> --}}

                     <td>
                        <select   name="operating_company" id="operating_company" driver_id_value="{{ $info->id }}" class="form-control">
                           <option   @if(old('operating_company',$info['operating_company'])=="") selected @endif  value=""> Select operating company</option>
                           <option   @if(old('operating_company',$info['operating_company'])==1 and old('operating_company',$info['operating_company'])!="") selected @endif  value="1"> Baladi</option>
                           <option   @if(old('operating_company',$info['operating_company'])==2 and old('operating_company',$info['operating_company'])!="") selected @endif  value="2"> External operating company</option>
                         </select>
                     </td>

                   
                  <td>
                     <a  href="{{ route('Operation.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Update driver data</a>
                     {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
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
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ secure_asset('assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script  src="{{ secure_asset('assets/admin/js/operation.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   /*     ═══════ ೋღ operating_contract_type  ღೋ ═══════    */

   $(document).on('change','#operating_contract_type', function(e){
      var operating_contract_type = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_operating_contract_type").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         operating_contract_type: operating_contract_type,
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

/*     ═══════ ೋღ operating_company  ღೋ ═══════    */

$(document).on('change','#operating_company', function(e){
      var operating_company = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_operating_company").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         operating_company: operating_company,
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
{{-- ===================================================== --}}