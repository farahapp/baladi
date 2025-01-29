@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead" style="background-color: purple;color:white">
      <th>   الرقم </th>
      <th>   الإسم </th>
      <th>     حالة المدرسة  </th>
      <th>    تقيم مدرب القيادة    </th>
      <th>      ملاحظات    </th>
               <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ (($data->firstItem() + $loop->index))  }}</td>
         <td>{{ $info->driver_name }}</td>
        


         <td>
            <select  name="driving_school_status" id="driving_school_status" driver_id_value="{{ $info->id }}" class="form-control select2 "
               isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
               isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
               @if (@isset($other['driving_school_status']) && !@empty($other['driving_school_status']))
               @foreach ($other['driving_school_status'] as $driving_school )
               <option @if(old('driving_school_status',$info->driving_school_status)==$driving_school->id) selected="selected" @endif value="{{ $driving_school->id }}" > {{ $driving_school->name }} </option>
               @endforeach
               @endif
            </select>
         </td>


      <td> 
         <select    name="driving_traning_range" id="driving_traning_range" driver_id_value="{{ $info->id }}" class="form-control"
            isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
            isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
         <option  @if(old('driving_traning_range',$info->driving_traning_range)==0) selected  @endif  value="0">لم يبداء</option>
         <option @if(old('driving_traning_range',$info->driving_traning_range)==1) selected @endif  value="1">ممتاز</option>
         <option @if(old('driving_traning_range',$info->driving_traning_range)==2 ) selected @endif value="2">جيد جدا</option>
         <option @if(old('driving_traning_range',$info->driving_traning_range)==3 ) selected @endif value="3">مقبول</option>
         <option @if(old('driving_traning_range',$info->driving_traning_range)==4 ) selected @endif value="4">سيئ</option>
         <option @if(old('driving_traning_range',$info->driving_traning_range)==5 ) selected @endif value="5">سيئ جدا </option>
         </select>
      </td> 

      
      <td> 
      <input  type="text" name="driver_school_notes" id="driver_school_notes" driver_id_value="{{ $info->id }}" oninput="change();" class="form-control" value="{{ old('driver_school_notes',$info->driver_school_notes) }}" placeholder="ملاحظات" 
      isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
      isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
      </td> 




        
         <td>
            <a  href="{{ route('School.edit',$info->id) }}" class="btn btn-primary btn-sm">بيانات اضافية</a>
         </td>
         
         
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}
      
      {{-- ///////////////////////////////////////////////////////////////// --}}

    
      @endforeach
   </tbody>
</table>


         <br>
         

         <div class="col-md-12 text-center" id="driving_school_ajax_pagination_in_search">
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif