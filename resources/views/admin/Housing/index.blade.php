@extends('layouts.admin')
@section('title')
Drivers data
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheader')
Housing List
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     Drivers</a>
<input type="hidden" id="token_search" value="{{csrf_token()}}">
<input type="hidden" id="ajax_search_url" value="{{route('Housing.ajax_search')}}">
<input type="hidden" id="ajax_update_flats" value="{{route('Housing.ajax_update_flats')}}">
<input type="hidden" id="ajax_update_uniform_status" value="{{route('Housing.ajax_update_uniform_status')}}">


@endsection
@section('contentheaderactive')
show
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">{{ __('mycustom.drivers_information') }} 
         </h3>
      </div>
      {{-- ============================================================================= --}}
      <div class="row" style="padding: 5px;">
         <div class="col-md-3">
            <div class="form-group">
               <label>  Search by name </label>
               <input type="text"  autofocus id="search_by_text" class="form-control" value="" placeholder="Search by name">
            </div>
         </div>

         {{-- <div class="col-md-3">
            <div class="form-group">
               <label> البحث عن طريق  رقم المبنى </label>
               <select name="bulding_search" id="bulding_search" class="form-control select2 ">
                  <option  value="all">البحث بالكل </option>
                  @if (@isset($flats) && !@empty($flats))
                  @foreach ($flats as $info )
                  <option @if(old('bulding_search')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{"مبنى:".$info->bulding_no}} </option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div> --}}

           <div class="col-md-3">
            <div class="form-group">
               <label> Search by apartment number </label>
               <select name="flats_search" id="flats_search" class="form-control select2 ">
                  <option  value="all">All </option>
                  @if (@isset($flats) && !@empty($flats))
                  <option  value="0">Outside the building  </option>
                  @foreach ($flats as $info )
                  <option @if(old('flats_search')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{"flat No::".$info->flat_No." bulding No:: ".$info->bulding_no}} </option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div>



         {{-- <div class="col-md-3">
            <div class="form-group">
               <label> البحث عن طريق  رقم الشقة </label>
                  <select  name="flats_search" id="flats_search" class="form-control select2 ">
                     <option  value="all">اختر المبنى أولا  </option>
               </select>
            </div>
         </div> --}}


         
      </div>
      {{-- ============================================================================= --}}

      <div class="card-body" id="flats_searchDiv" style="background-size: cover; background-image: url('{{ asset('/../assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>{{ __('mycustom.driver_name') }}</th>
               <th>Image</th>
               {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
               <th>Building number</th>
               <th>{{ __('mycustom.driver_flat_no') }}</th>
               {{-- <th>{{ __('mycustom.uniform_status') }}</th> --}}
               <th></th>
            </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->driver_name }}</td>
                  <td><img src="{{ asset('assets/admin/uploads').'/'.$info->driver_photo }}"></td>
 

                     {{-- <td 
                     @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
                     @endif
                     </td> --}}

                     {{-- <td 
                     @if ($info->appartment_no==0) class="text-danger" @else class="text-success"  @endif > @if ($info->appartment_no==0) لا يسكن  @else  {{ $info->Flats->bulding_no }}   
                     @endif
                     </td> --}}

                     <td>
                     <select  name="bulding" id="buldingID" driver_id_value="{{$info->id}}" class="form-control select2 ">
                        <option  value=""> Bulding  </option>
                        @if (@isset($flats) && !@empty($flats))
                        @foreach ($flatsunique as $info2 )
                        {{-- @if (@isset($info->appartment_no) && !@empty($info->appartment_no) && $info->appartment_no !=0 ) --}}
                        @if (@isset($info->Flats) && !@empty($info->Flats))
                        <option @if(old('buldingID',$info->Flats->bulding_no)==$info2->bulding_no) selected="selected" @endif  value="{{ $info2->bulding_no }}"> {{ $info2->bulding_no }} </option>
                        @else
                        <option @if(old('buldingID')==$info2->bulding_no) selected="selected" @endif  value="{{ $info2->bulding_no }}"> {{ $info2->bulding_no }} </option>
                        @endif
                        @endforeach
                        @endif
                     </select>
                    </td>


                     {{-- <td 
                     @if ($info->appartment_no==0) class="text-danger" @else class="text-success"  @endif > @if ($info->appartment_no==0) لا يسكن  @else  {{ $info->Flats->flat_No }}   
                     @endif
                     </td> --}}

                     <td>
                        <div name="flats{{$info->id}}" id="flats{{$info->id}}">
                           @if (@isset($info->appartment_no) && !@empty($info->appartment_no) && $info->appartment_no !=0 )
                           <select  name="flats" id="flats" class="form-control select2" driver_id_value="{{$info->id}}">
                              <option  value="0">Outside the building  </option>
                              @if (@isset($info->Flats) && !@empty($info->Flats))
                              @foreach ($flats as $info2 )
                              <option @if(old('flats',$info->Flats->flat_No)==$info2->flat_No) selected="selected" @endif value="{{ $info2->id }}"> {{"flat No:".$info2->flat_No}} </option>
                              @endforeach
                              @endif
                           </select>
                           @else
                           <select   class="form-control select2">
                              <option  value="">Select the building first.  </option>
                              {{-- <option  value=""> الشقة  </option>
                              @if (@isset($flats) && !@empty($flats))
                              @foreach ($flats as $info )
                              <option  value="{{ $info->bulding_no }}"> {{ $info->flat_No }} </option>
                              @endforeach
                              @endif
                              <option  value="0">خارج المبنى  </option> --}}
                           </select>
      
                           @endif
                      
                        </div>
                       </td>
   

                     {{-- <td 
                     @if ($info->uniform_status==0) class="text-danger" @else class="text-success"  @endif > 
                     @if ($info->uniform_status==0) لم يتم اي اجراء 
                     @elseif ($info->uniform_status==1) تم قياس الزي الرسمي ولم يتم السليم   
                     @else تم تسليم الزي الرسمي للسائق   
                     @endif
                     </td> --}}


                     {{-- <td>
                        <select  name="uniform_status" id="uniform_status" class="form-control" driver_id_value="{{$info->id}}">
                           <option   @if(old('uniform_status',$info->uniform_status)==0) selected @endif  value="0">لم يتم اي اجراء</option>
                           <option   @if(old('uniform_status',$info->uniform_status)==1) selected @endif  value="1">   تم قياس الزي الرسمي ولم يتم السليم     </option>
                           <option @if(old('uniform_status',$info->uniform_status)==2) selected @endif value="2"> تم تسليم الزي الرسمي للسائق </option>
                        </select>
                       </td>
                    --}}

               
                  <td>
                     <a  href="{{ route('Housing.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">{{ __('mycustom.update_driver_data') }}</a>
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
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif
      </div>
   </div>
</div>
@endsection
@section("script")
<script  src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('assets/admin/js/housing.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   $(document).on('change','#buldingID',function(e){
      var driver_id_value=$(this).attr("driver_id_value");
      // var bulding_no=$(this).val();
      var bulding_no=$(this).val();
      var old_flats_id = "0";
      jQuery.ajax({
      url:'{{ route('Housing.get_flats') }}',
      type:'post',
      'dataType':'html',
      cache:false,
      data:{"_token":'{{ csrf_token() }}',
      bulding_no:bulding_no,
      old_flats_id:driver_id_value
      },
      success: function(data){
      // alert("flats"+driver_id_value);
      $("#flats"+driver_id_value).html(data);
      },
      error:function(){
      alert("عفوا لقد حدث خطأ ");
      },
      });

      });

   

      
   $(document).on('change','#uniform_status', function(e){
      var uniform_status = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_uniform_status").val();
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         uniform_status: uniform_status,
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



      
      // $(document).on('change','#flatsData', function(e){
      //    alert("kkk");
      // });

      

         $(document).on('change','#flats', function(e){
      var flats = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var token_search = $("#token_search").val();
         var ajax_url = $("#ajax_update_flats").val();
         jQuery.ajax({
            url: ajax_url,
            type: 'post',
            dataType: 'html',
            cache: false,
            data: {
               flats: flats,
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

