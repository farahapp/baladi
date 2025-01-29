@if(@isset($data) and !@empty($data) and count($data)>0 )
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>{{ __('mycustom.driver_name') }}</th>
      {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
      {{-- <th>{{ __('mycustom.signing_all_contract_and_debt') }}</th> --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(22)==true)
      <th>مجموعة الانجليزي</th>
      <th>{{ __('mycustom.english_lectures_atendence_range') }}</th>
      <th>{{ __('mycustom.english_lectures_understand_range') }}</th>
      @endif
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(23)==true)
      <th>{{ __('mycustom.talabat_lectures_atendence_range') }}</th>
      <th>{{ __('mycustom.talabat_lectures_understand_range') }}</th>
      @endif
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(24)==true)
      <th>{{ __('mycustom.atucate_lectures_atendence_range') }}</th>
      <th>{{ __('mycustom.etiquette_lectures_understand_range') }}</th>
      @endif
      {{-- <th>{{ __('mycustom.driving_school_status') }}</th> --}}
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ $info->driver_name }}</td>
    
            {{-- <td 
            @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
            @endif
            </td> --}}


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


            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(22)==true)

            <td>
            <select    name="english_group" id="english_group" driver_id_value="{{ $info->id }}" class="form-control"
               isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
               isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}">
               <option @if(old('english_group',$info->english_group)==0) selected @endif  value="0">لم يبداء</option>
               <option @if(old('english_group',$info->english_group)==1) selected @endif  value="1">C</option>
               <option @if(old('english_group',$info->english_group)==2 ) selected @endif value="2">B</option>
               <option @if(old('english_group',$info->english_group)==3 ) selected @endif value="3">A</option>
               </select>
            </td>

            <td>
               <select    name="english_lectures_atendence_range" id="english_lectures_atendence_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('english_lectures_atendence_range',$info->english_lectures_atendence_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>


            {{-- <td 
            @if ($info->english_lectures_atendence_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->english_lectures_atendence_range==0) لم يبداء 
            @elseif ($info->english_lectures_atendence_range==1)   ممتاز       
            @elseif ($info->english_lectures_atendence_range==2)   جيد جدا       
            @elseif ($info->english_lectures_atendence_range==3)   مقبول       
            @elseif ($info->english_lectures_atendence_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}

            <td>
               <select    name="english_lectures_understand_range" id="english_lectures_understand_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('english_lectures_understand_range',$info->english_lectures_understand_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>

            {{-- <td 
            @if ($info->english_lectures_understand_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->english_lectures_understand_range==0) لم يبداء 
            @elseif ($info->english_lectures_understand_range==1)   ممتاز       
            @elseif ($info->english_lectures_understand_range==2)   جيد جدا       
            @elseif ($info->english_lectures_understand_range==3)   مقبول       
            @elseif ($info->english_lectures_understand_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}

            @endif

            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(23)==true)

            <td>
               <select    name="talabat_lectures_atendence_range" id="talabat_lectures_atendence_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('talabat_lectures_atendence_range',$info->talabat_lectures_atendence_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>

            {{-- <td 
            @if ($info->talabat_lectures_atendence_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->talabat_lectures_atendence_range==0) لم يبداء 
            @elseif ($info->talabat_lectures_atendence_range==1)   ممتاز       
            @elseif ($info->talabat_lectures_atendence_range==2)   جيد جدا       
            @elseif ($info->talabat_lectures_atendence_range==3)   مقبول       
            @elseif ($info->talabat_lectures_atendence_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}


            <td>
               <select    name="talabat_lectures_understand_range" id="talabat_lectures_understand_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('talabat_lectures_understand_range',$info->talabat_lectures_understand_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>

            {{-- <td 
            @if ($info->talabat_lectures_understand_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->talabat_lectures_understand_range==0) لم يبداء 
            @elseif ($info->talabat_lectures_understand_range==1)   ممتاز       
            @elseif ($info->talabat_lectures_understand_range==2)   جيد جدا       
            @elseif ($info->talabat_lectures_understand_range==3)   مقبول       
            @elseif ($info->talabat_lectures_understand_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}

            @endif


            @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(24)==true)


            <td>
               <select    name="atucate_lectures_atendence_range" id="atucate_lectures_atendence_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('atucate_lectures_atendence_range',$info->atucate_lectures_atendence_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>


            {{-- <td 
            @if ($info->atucate_lectures_atendence_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->atucate_lectures_atendence_range==0) لم يبداء 
            @elseif ($info->atucate_lectures_atendence_range==1)   ممتاز       
            @elseif ($info->atucate_lectures_atendence_range==2)   جيد جدا       
            @elseif ($info->atucate_lectures_atendence_range==3)   مقبول       
            @elseif ($info->atucate_lectures_atendence_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}


            <td>
               <select    name="atucate_lectures_understand_range" id="atucate_lectures_understand_range" driver_id_value="{{ $info->id }}" class="form-control"
                  isGivePassPort="{{ $info->isGivePassPort }}"  isSigningMainContract="{{ $info->isSigningMainContract }}" 
                  isSigningFullFinancialDebt="{{ $info->isSigningFullFinancialDebt }}"  isSigningPenaltyClause="{{ $info->isSigningPenaltyClause }}" >
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==0) selected @endif  value="0">لم يبداء</option>
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==1) selected @endif  value="1">ممتاز</option>
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==2 ) selected @endif value="2">جيد جدا</option>
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==3 ) selected @endif value="3">مقبول</option>
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==4 ) selected @endif value="4">سيئ</option>
                  <option @if(old('atucate_lectures_understand_range',$info->atucate_lectures_understand_range)==5 ) selected @endif value="5">سيئ جدا </option>
                  </select>
               </td>


            {{-- <td 
            @if ($info->atucate_lectures_understand_range==1) class="text-success" @else class="text-danger"  @endif > 
            @if ($info->atucate_lectures_understand_range==0) لم يبداء 
            @elseif ($info->atucate_lectures_understand_range==1)   ممتاز       
            @elseif ($info->atucate_lectures_understand_range==2)   جيد جدا       
            @elseif ($info->atucate_lectures_understand_range==3)   مقبول       
            @elseif ($info->atucate_lectures_understand_range==4)   سيئ       
            @else سيئ جدا        
            @endif
            </td> --}}



            @endif




            {{-- <td class="text-info">
               {{ $info->Driving_school_status->name }} 
            </td> --}}



      
         <td>
            <a  href="{{ route('Training.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تحديث بيانات السائق</a>
            {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>

<br>
<div class="col-md-12 text-center" id="training_ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
