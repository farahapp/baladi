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
               <th>    اسم السائق</th>
               <th> توقيع الشرط الجزائي والمديونية </th>
               <th>إجمالي المديونية</th>
               <th>المبلغ المسدد</th>
               <th>المبلغ المتبقي</th>
               <th>المبلغ المورد   من السائق</th>
               <th>صافي المديونية </th>
               <th>   عدد السلفيات </th>
               <th>   إجمالي السلفيات </th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td>{{ $info->driver_name }}</td>
             
                  


                     <td 
                  @if ($info->isSigningInitialContract!=1
                  || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                  ) class="text-danger" @else class="text-success"  @endif >
                   @if ($info->isSigningInitialContract!=1
                     || $info->isGivePassPort!=1
                  || $info->isSigningMainContract!=1
                  || $info->isSigningFullFinancialDebt!=1
                  || $info->isSigningPenaltyClause!=1
                   ) غير موقع @else  موقع 
                  @endif
                  </td>



                  @if ($info->GeneralLoan->total_loan!=null||$info->GeneralLoan->total_loan!='')
                  <td>{{$info->GeneralLoan->total_loan}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif


                  @if ($info->GeneralLoan->total_loan!=null||$info->GeneralLoan->total_loan!='')
                  <td>{{$info->GeneralLoan->total_loan_paid}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif


                  @if ($info->GeneralLoan->total_loan!=null||$info->GeneralLoan->total_loan!='')
                  <td>{{$info->GeneralLoan->total_loan_remaining}}</td>
                  @else
                  <td>لم يتم حساب المديونية</td>
                  @endif

                  @if ($info->isPostPayInSudan!=0)
                  <td>{{$info->post_pay_amount}}</td>
                  @else
                  <td>لايوجد </td>
                  @endif

                

                  @if ($info->isPostPayInSudan!=0)
                  <td>{{$info->GeneralLoan->total_loan-$info->post_pay_amount}}</td>
                  @else
                  <td>لايوجد </td>
                  @endif
            



                  <td>{{ \App\Models\SpecialLoan::where('driver_id',$info->id)->count() }}</td>


                  <td>{{ \App\Models\SpecialLoan::where('driver_id',$info->id)->sum('loan_value') }}</td>

                  {{-- <td>{{\App\SpecialLoan::sum('loan_value')}} --}}



                   



               
                  <td>
                     <a  href="{{ route('financial.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">ملاحظات مالية للسائق</a>
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