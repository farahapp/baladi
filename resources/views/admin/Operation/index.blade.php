@extends('layouts.admin')
@section('title')
بيانات السائقين
@endsection
@section('contentheader')
قائمة السائقين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">{{ __('mycustom.drivers') }}</a>
@endsection
@section('contentheaderactive')
عرض
@endsection

@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
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
            <input checked type="radio" name="searchbyradio" id="searchbyradio" value="vechile_driver"> سائق المركبة
            <input type="radio" name="searchbyradio" id="searchbyradio"  value="vechile_no"> رقم اللوحة
            <input  autofocus style="margin-top 6px !important;" type="text" name="search_by_text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق نوع المركبة </label>
            <select  name="vechile_car_or_bike_search" id="vechile_car_or_bike_search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="1">سيارة</option>
            <option  value="2">دراجة نارية</option>
            </select>
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق طراز المركبة </label>
            <select name="vechile_model_search" id="vechile_model_search" class="form-control select2 ">
               <option  value="all">البحث بالكل </option>
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
            <label> البحث عن طريق حالة المركبة </label>
            <select  name="vechile_status_search" id="vechile_status_search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="1">تعمل</option>
            <option  value="0">متعطلة</option>
            <option  value="2">تحت الصيانة</option>
            </select>
         </div>
      </div>


      <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق المشغل  </label>
            <select  name="operating_company_search" id="operating_company_search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="1">Baladi</option>
               <option  value="2">External operating company</option>
            </select>
         </div>
      </div>

      <div class="col-md-3">
         <div class="form-group">
            <label> البحث عن طريق نوع العقد   </label>
            <select  name="operating_contract_type_search" id="operating_contract_type_search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="1">عقد حر</option>
            <option  value="2">800 ريال</option>
            </select>
         </div>
      </div>

      <div class="col-md-2">
         <div class="form-group">
            <label> .</label></br>
            <button type="post" class="btn btn-sm btn-info custom_button">طباعة البحث</button>
         </div>
      </div>


        

      </div>
   </form>



      <div class="card-body" id="ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>الرقم  </th>
               <th>{{ __('mycustom.driver_name') }}</th>
               <th>نوع المركبة</th>
               <th>موديل المركبة</th>
               <th>الجنسية</th>
               <th>نوع العقد</th>
               <th>المشغل</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ (($data->firstItem() + $loop->index))  }}</td>
                  <td>{{ $info->driver_name }}</td>
                  <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
                     @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
                     
                     @if ($info->Driver_vechile->vechile_car_or_bike==1) سيارة  @else دراجة نارية   
                     @endif

                     {{-- {{ $info->Driver_vechile->vechile_car_or_bike }} --}}

                     @else
                     لايوجد 
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

                     <td>
                        <select   name="operating_contract_type" id="operating_contract_type" driver_id_value="{{ $info->id }}" class="form-control">
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])=="") selected @endif  value=""> إختر نوع العقد</option>
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])==1 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="1">عقد حر</option>
                           <option   @if(old('operating_contract_type',$info['operating_contract_type'])==2 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="2">800 ريال</option>
                         </select>
                     </td>

                     <td>
                        <select   name="operating_company" id="operating_company" driver_id_value="{{ $info->id }}" class="form-control">
                           <option   @if(old('operating_company',$info['operating_company'])=="") selected @endif  value=""> إختر المشغل</option>
                           <option   @if(old('operating_company',$info['operating_company'])==1 and old('operating_company',$info['operating_company'])!="") selected @endif  value="1"> Baladi</option>
                           <option   @if(old('operating_company',$info['operating_company'])==2 and old('operating_company',$info['operating_company'])!="") selected @endif  value="2"> External operating company</option>
                         </select>
                     </td>

                   
                  <td>
                     <a  href="{{ route('Operation.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تحديث بيانات السائق</a>
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
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/js/operation.js') }}"> </script>
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