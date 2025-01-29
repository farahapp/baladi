@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead" style="background-color: purple;color:white">
      <th>   الإسم </th>
      <th>       توقيع العقود  </th>
      <th>      رخصة سودانية  </th>
      <th>     حالة المدرسة  </th>
      <th>    تقيم مدرب القيادة    </th>
      
   
      {{-- <th></th> --}}
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td style="background-color: brown;color:white">{{ $info->driver_name }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
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


         <td 
         @if ($info->does_has_sudanese_Driving_License==0) class="text-danger" @else class="text-success"  @endif > 
         @if ($info->does_has_sudanese_Driving_License==0) ليس لديه رخصة 
         @elseif ($info->does_has_sudanese_Driving_License==1)  لديه رخصة        
         @endif
         </td>



         <td>
               <select  name="driving_school_status" id="driving_school_status" driver_id_value="{{ $info->id }}" class="form-control select2 ">
                  @if (@isset($other['driving_school_status']) && !@empty($other['driving_school_status']))
                  @foreach ($other['driving_school_status'] as $driving_school )
                  <option @if(old('driving_school_status',$info->driving_school_status)==$driving_school->id) selected="selected" @endif value="{{ $driving_school->id }}" > {{ $driving_school->name }} </option>
                  @endforeach
                  @endif
               </select>
               
            </td>


         <td> 
            <select    name="driving_traning_range" id="driving_traning_range" driver_id_value="{{ $info->id }}" class="form-control">
            <option  @if(old('driving_traning_range',$info->driving_traning_range)==0) selected  @endif  value="0">لم يبداء</option>
            <option @if(old('driving_traning_range',$info->driving_traning_range)==1) selected @endif  value="1">ممتاز</option>
            <option @if(old('driving_traning_range',$info->driving_traning_range)==2 ) selected @endif value="2">جيد جدا</option>
            <option @if(old('driving_traning_range',$info->driving_traning_range)==3 ) selected @endif value="3">مقبول</option>
            <option @if(old('driving_traning_range',$info->driving_traning_range)==4 ) selected @endif value="4">سيئ</option>
            <option @if(old('driving_traning_range',$info->driving_traning_range)==5 ) selected @endif value="5">سيئ جدا </option>
            </select>
         </td> 


        
         {{-- <td>
            <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
         </td> --}}

         
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}
      
      {{-- ///////////////////////////////////////////////////////////////// --}}

    
      @endforeach
   </tbody>
</table>


         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif