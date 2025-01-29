@if(@isset($data) and !@empty($data) and count($data)>0 )
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead" style="background-color: purple;color:white">
      <th>   الرقم </th>
      <th>   الإسم </th>
      <th>     حالة الإقامة  </th>
      <th>     حالة البنك  </th>
      <th>     الحالة الوظيفية </th>

      
   
      {{-- <th></th> --}}
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ $info->id }}</td>
         <td>{{ $info->driver_name }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
      





  



         <td>
            <select  name="driver_residency_process_status" id="driver_residency_process_status" driver_id_value="{{ $info->id }}" class="form-control select2 "
               isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
               isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
               @if (@isset($other['residency_process_status']) && !@empty($other['residency_process_status']))
               @foreach ($other['residency_process_status'] as $residency_status )
               <option @if(old('driver_residency_process_status',$info->driver_residency_process_status)==$residency_status->id) selected="selected" @endif value="{{ $residency_status->id }}" > {{ $residency_status->name }} </option>
               @endforeach
               @endif
            </select>
            
         </td>


         <td>
            <select  name="driver_bank_process" id="driver_bank_process" driver_id_value="{{ $info->id }}" class="form-control select2 "
               isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
               isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
               @if (@isset($other['driver_bank_process']) && !@empty($other['driver_bank_process']))
               @foreach ($other['driver_bank_process'] as $bank_process )
               <option @if(old('driver_bank_process',$info->driver_bank_process)==$bank_process->id) selected="selected" @endif value="{{ $bank_process->id }}" > {{ $bank_process->name }} </option>
               @endforeach
               @endif
            </select>
            
         </td>


         <td>
            <select   name="Functional_status" id="Functional_status" driver_id_value="{{ $info->id }}" class="form-control"
               isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
               isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
               <option   @if(old('Functional_status',$info['Functional_status'])==1) selected @endif  value="1">تحت التدريب</option>
               <option   @if(old('Functional_status',$info['Functional_status'])==2 and old('Functional_status',$info['Functional_status'])!="") selected @endif  value="2"> التشغيل</option>
               <option   @if(old('Functional_status',$info['Functional_status'])==3 and old('Functional_status',$info['Functional_status'])!="") selected @endif  value="3"> اداري</option>
               <option @if(old('Functional_status',$info['Functional_status'])==0 and old('Functional_status',$info['Functional_status'])!="" ) selected @endif value="0">خارج العمل</option>
             </select>
         </td>





       


    
    
      @endforeach
   </tbody>
</table>
<br>
<div class="col-md-12 text-center" id="GovernmentProcess_ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
