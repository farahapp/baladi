@extends('layouts.admin')
@section('title')
{{ __('mycustom.profile') }}
@endsection
@section('contentheader')
{{ __('mycustom.setting') }}
@endsection
@section('contentheaderactivelink')
<a href="{{ route('userProfile.index') }}">{{ __('mycustom.profile') }}</a>
@endsection
@section('contentheaderactive')
Details
@endsection
@section('content')
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">{{ __('mycustom.profile_details') }}</h3>
            
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">{{ __('mycustom.user_name') }}</td>
                  <td > {{ $data['name'] }}</td>
               </tr>

               <tr>
                  <td class="width30">{{ __('mycustom.user_role') }}</td>
                  <td > {{ $data->permission_rols->name}}</td>
               </tr>

               <tr>
                  <td class="width30">{{ __('mycustom.user_email') }}</td>
                  <td > {{ $data['email']}}</td>
               </tr>

               <tr>
                  <td class="width30">{{ __('mycustom.user_status') }}</td>
                  <td > @if($data['active']==1) activated  @else Not activated @endif</td>
               </tr>
               <tr>
                  <td class="width30">{{ __('mycustom.addition_date') }}</td>
                  <td > 
                     @php
                     $dt=new DateTime($data['created_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'AM ':'PM'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}

                     {{ __('mycustom.by') }}
 
                     {{ $data->added->name }}
                  </td>
               </tr>
               <tr>
                  <td class="width30">{{ __('mycustom.updating_date') }}</td>
                  <td > 
                     @if($data['updated_by']>0 and $data['updated_by']!=null )
                     @php
                     $dt=new DateTime($data['updated_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'AM ':'PM'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}

                     {{ __('mycustom.by') }}
                      
                     
                     {{ $data->added->name }}
                     @else
                     There is no update.
                     @endif
                  </td>
               </tr>
               <tr>
                  <td colspan="2" class="text-center">
                     <a href="{{ route('userProfile.edit') }}" class="btn btn-sm btn-success">{{ __('mycustom.update') }}</a>
                  </td>
               </tr>
            </table>

            @else
            <p class="bg-danger text-center"> Sorry, there is no data to display.</p>
            @endif

          
         </div>
   </div>
</div>

@endsection
