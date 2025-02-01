@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section('contentheader')
{{ __('mycustom.financial_adminstration_list') }}
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">{{ __('mycustom.loan') }}</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  {{ __('mycustom.loan_data') }} 
            <a href="{{ route('financial.specialLoans_create') }}" class="btn btn-sm btn-warning">{{ __('mycustom.add_loan') }}</a>
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv" style="background-size: cover; background-image: url('{{ secure_asset('assets/admin/imgs/doha.webp') }}')">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <main class="table">
            <section class="table__body">
         <table id="example2">
            <thead>
               <tr>
               <th>{{ __('mycustom.loan_applicant') }}</th>
               <th>{{ __('mycustom.loan_name') }}</th>
               <th>{{ __('mycustom.loan_amount') }}</th>
               <th>{{ __('mycustom.loan_status') }}</th>
               <th>{{ __('mycustom.loan_application_date') }}</th>
               <th></th>
               </tr>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>


                  <td>{{ $info->Driver_id->driver_name }}</td>


                  {{-- <td>{{ $info->driver_id }}</td> --}}

                  

               
                  <td>{{ $info->loan_name }}</td>
                  <td>{{ $info->loan_value." riyal " }}</td>

                  
                  <td 
                  @if ($info->loan_status==0) class="text-danger" @else class="text-success"  @endif > 
                  @if ($info->loan_status==0) Not approved  
                  @elseif ($info->loan_status==1)   Approved       
                  @elseif ($info->loan_status==2)   The amount has been delivered.        
                  @elseif ($info->loan_status==3)  The loan was declined.       
                  @else   حدث خطا    
                  @endif
                  </td>

             
                  <td>
                     @php
                     $dt=new DateTime($info->created_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("a",strtotime($info->created_at));
                     $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }} <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->added->name }} 
                  </td>
 

               
                  <td>
                     <a  href="{{ route('financial.specialLoans_edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">{{ __('mycustom.update_loan_data') }}</a>
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