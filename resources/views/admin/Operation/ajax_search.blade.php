@if(@isset($data) and !@empty($data) and count($data)>0 )
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>الرقم  </th>
      <th>{{ __('mycustom.driver_name') }}</th>
      <th>نوع المركبة</th>
      <th>موديل المركبة</th>
      <th>الجنسية</th>
      <th>نوع العقد</th>
      <th>المشغل</th>
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ (($data->firstItem() + $loop->index))  }}</td>
         <td>{{ $info->driver_name }}</td>
         <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
            @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
            
            @if ($info->Driver_vechile->vechile_car_or_bike==1) سيارة  @else دراجة نارية   
            @endif

            {{-- {{ $info->Driver_vechile->vechile_car_or_bike }} --}}

            @else
            لايوجد 
            @endif
            </td>
         {{-- @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile) and $other['vechile_model'][$info->Driver_vechile->vechile_model]['id'] ==  $info->Driver_vechile->vechile_model ) --}}
         <td  @if ($info->Driver_vechile!='') class="text-success" @else class="text-warning"  @endif>
          @if(@isset($info->Driver_vechile) and !@empty($info->Driver_vechile)  )
          {{ $other['vechile_model'][$info->Driver_vechile->vechile_model-1]['name'] }}
         {{-- @if (@isset($info->Driver_vechile->vechile_model) && !@empty($info->Driver_vechile->vechile_model)) --}}
         {{-- @php --}}
         {{-- // $array = App\Vechile_Model::Select(id)->get(); --}}
        {{-- //   $value = App\Vechile_Model::select("id")->where($id,"=",$info->Driver_vechile->vechile_model)->first()  --}}
         {{-- @endphp --}}
         @else
         لايوجد 
         @endif
         </td>


         <td>{{ $info->Nationalities->name }}</td>

         {{-- <td>{{ $info->driver_residency_permit_id }}</td> --}}

         {{-- $other['vechile_information'] --}}


            {{-- <td 
            @if ($info->appointment_type==1) class="text-success" @else class="text-warning"  @endif > @if ($info->appointment_type==1) قادم من البلد الام  @else من داخل قطر (داخلي)    
            @endif
            </td> --}}

            <td>
               <select   name="operating_contract_type" id="operating_contract_type" driver_id_value="{{ $info->id }}" class="form-control">
                  <option   @if(old('operating_contract_type',$info['operating_contract_type'])=="") selected @endif  value=""> إختر نوع العقد</option>
                  <option   @if(old('operating_contract_type',$info['operating_contract_type'])==1 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="1">عقد حر</option>
                  <option   @if(old('operating_contract_type',$info['operating_contract_type'])==2 and old('operating_contract_type',$info['operating_contract_type'])!="") selected @endif  value="2">800 ريال</option>
                </select>
            </td>

            <td>
               <select   name="operating_company" id="operating_company" driver_id_value="{{ $info->id }}" class="form-control">
                  <option   @if(old('operating_company',$info['operating_company'])=="") selected @endif  value=""> إختر المشغل</option>
                  <option   @if(old('operating_company',$info['operating_company'])==1 and old('operating_company',$info['operating_company'])!="") selected @endif  value="1"> Baladi</option>
                  <option   @if(old('operating_company',$info['operating_company'])==2 and old('operating_company',$info['operating_company'])!="") selected @endif  value="2"> External operating company</option>
                </select>
            </td>

          
         <td>
            <a  href="{{ route('Operation.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">تحديث بيانات السائق</a>
            {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
<br>

<div class="col-md-12 text-center" id="ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
