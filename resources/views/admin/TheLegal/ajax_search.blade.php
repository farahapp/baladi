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
         

         <div class="col-md-12 text-center" id="the_legal_ajax_pagination_in_search">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif