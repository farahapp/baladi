@extends('layouts.admin')
@section('title')
بيانات الموظفين
@endsection
@section('contentheader')
قائمة الضبط
@endsection
@section('contentheaderactivelink')
<a href="{{ route('financial.index') }}">     الموظفين</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات  السائقين 
         </h3>
      </div>
      <div class="card-body" id="ajax_responce_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>{{ __('mycustom.driver_name') }}</th>
               <th>{{ __('mycustom.etiquette_lectures_atendence_range') }}</th>
               {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
               <th>إجمالي المديونية</th>
               <th>المبلغ المسدد</th>
               <th>المبلغ المتبقي</th>
               <th>المبلغ المورد   من السائق</th>
               <th>صافي المديونية </th>
               {{-- <th>{{ __('mycustom.driver_bank_process') }}</th> --}}
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->Employee->driver_name }}</td>


                  {{-- <td 
                  @if ($info->Employee->arrive_qater_date==null||$info->Employee->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->Employee->arrive_qater_date==null||$info->Employee->arrive_qater_date=="") خارج قطر @else داخل قطر  
                  @endif
                  </td> --}}

                  <td 
                  @if ($info->Employee->isSigningInitialContract!=1
                  || $info->Employee->isGivePassPort!=1
                  || $info->Employee->isSigningMainContract!=1
                  || $info->Employee->isSigningFullFinancialDebt!=1
                  || $info->Employee->isSigningPenaltyClause!=1
                  ) class="text-danger" @else class="text-success"  @endif >
                   @if ($info->Employee->isSigningInitialContract!=1
                     || $info->Employee->isGivePassPort!=1
                  || $info->Employee->isSigningMainContract!=1
                  || $info->Employee->isSigningFullFinancialDebt!=1
                  || $info->Employee->isSigningPenaltyClause!=1
                   ) غير موقع @else  موقع 
                  @endif
                  </td>



                  @if ($info->total_loan!=null||$info->total_loan!='')
                  <td>{{$info->total_loan}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif


                  @if ($info->total_loan!=null||$info->total_loan!='')
                  <td>{{$info->total_loan_paid}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif


                  @if ($info->total_loan!=null||$info->total_loan!='')
                  <td>{{$info->total_loan_remaining}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif

                  @if ($info->Employee->isPostPayInSudan!=0)
                  <td>{{$info->Employee->post_pay_amount}}</td>
                  @else
                  <td>لايوجد </td>
                  @endif

                

                  @if ($info->Employee->isPostPayInSudan!=0)
                  <td>{{$info->total_loan-$info->Employee->post_pay_amount}}</td>
                  @else
                  <td>لايوجد </td>
                  @endif
            


                     {{-- <td 
                     @if ($info->Employee->driver_bank_process==1) class="text-success" @else class="text-danger"  @endif > @if ($info->Employee->driver_bank_process==1) تمت الطباعة @else لم تتم الطباعة  
                     @endif
                     </td> --}}



               
                  <td>
                     <a  href="{{ route('financial.generalLoans_edit',$info->Employee->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تحديث بيانات المديونية</a>
                     {{-- <a  href="{{ route('Religions.destroy',$info->Employee->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
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