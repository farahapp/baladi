@if(@isset($data) and !@empty($data) and count($data)>0 )
<main class="table">
   <section class="table__body">
<table id="example2">
   <thead>
      <tr>
      <th>No  </th>
      <th>{{ __('mycustom.driver_name') }}</th>
      <th>Image</th>
      {{-- <th>{{ __('mycustom.driver_pasport_no') }}</th> --}}
      <th>{{ __('mycustom.driver_baladi_id') }}</th>
      <th>{{ __('mycustom.nationalty') }}</th>
      {{-- <th>{{ __('mycustom.signing_initial_contract') }}</th> --}}
      {{-- <th>{{ __('mycustom.signing_all_contract_and_debt') }}</th> --}}
      {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
      {{-- <th>{{ __('mycustom.give_passport') }}</th> --}}
      {{-- <th>{{ __('mycustom.signing_main_contract') }}</th>
      <th>{{ __('mycustom.signing_full_financial_debt') }}</th>
      <th>{{ __('mycustom.signing_penalty_clause') }}</th> --}}
      {{-- <th>{{ __('mycustom.driver_bank_process') }}</th> --}}
      <th>{{ __('mycustom.team') }}</th>
      <th></th>
      </tr>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ (($data->firstItem() + $loop->index))  }}</td>
         {{-- للترتيب التنازلي نستخدم الدالة التحت
         <td>{{ $data->firstItem() + ($data->count() - $loop->index)}}</td>  --}}
         <td>{{ $info->driver_name }}</td>
         <td><img src="{{ asset('assets/admin/uploads').'/'.$info->driver_photo }}"></td>
         <td>{{ $info->baladi_id }}</td>

         <td>{{ $info->Nationalities->name }}</td>

    
         {{-- <td 
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
         </td> --}}

         
            {{-- <td 
            @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
            @endif
            </td> --}}

 



            <td 
            @if ($info->appointment_type==1) class="text-success" @else class="text-warning"  @endif > @if ($info->appointment_type==1) Coming from home country  @else From within Qatar (internal)    
            @endif
            </td>




      
         <td>
            <a  href="{{ route('HumanResource.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">Update driver data</a>
            {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
</section>
</main>
<br>
<div class="col-md-12 text-center" id="ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
