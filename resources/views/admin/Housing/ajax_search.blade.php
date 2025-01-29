@if(@isset($data) and !@empty($data) and count($data)>0 )
<main class="table">
   <section class="table__body">
<table id="example2">
   <thead>
      <tr>
      <th>{{ __('mycustom.driver_name') }}</th>
      <th>Image</th>
      {{-- <th>{{ __('mycustom.arrive_qater_date') }}</th> --}}
      <th>رقم المبنى</th>
      <th>{{ __('mycustom.driver_flat_no') }}</th>
      {{-- <th>{{ __('mycustom.uniform_status') }}</th> --}}
      <th></th>
   </tr>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td>{{ $info->driver_name }}</td>
         <td><img src="{{ asset('/../assets/admin/uploads').'/'.$info->driver_photo }}"></td>


            {{-- <td 
            @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") class="bg-danger" @else class="bg-success"  @endif > @if ($info->arrive_qater_date==null||$info->arrive_qater_date=="") خارج قطر @else داخل قطر  
            @endif
            </td> --}}

            {{-- <td 
            @if ($info->appartment_no==0) class="text-danger" @else class="text-success"  @endif > @if ($info->appartment_no==0) لا يسكن  @else  {{ $info->Flats->bulding_no }}   
            @endif
            </td> --}}

            <td>
            <select  name="bulding" id="buldingID" driver_id_value="{{$info->id}}" class="form-control select2 ">
               <option  value=""> Bulding  </option>
               @if (@isset($flats) && !@empty($flats))
               @foreach ($flatsunique as $info2 )
               {{-- @if (@isset($info->appartment_no) && !@empty($info->appartment_no) && $info->appartment_no !=0 ) --}}
               @if (@isset($info->Flats) && !@empty($info->Flats))
               <option @if(old('buldingID',$info->Flats->bulding_no)==$info2->bulding_no) selected="selected" @endif  value="{{ $info2->bulding_no }}"> {{ $info2->bulding_no }} </option>
               @else
               <option @if(old('buldingID')==$info2->bulding_no) selected="selected" @endif  value="{{ $info2->bulding_no }}"> {{ $info2->bulding_no }} </option>
               @endif
               @endforeach
               @endif
            </select>
           </td>


            {{-- <td 
            @if ($info->appartment_no==0) class="text-danger" @else class="text-success"  @endif > @if ($info->appartment_no==0) لا يسكن  @else  {{ $info->Flats->flat_No }}   
            @endif
            </td> --}}

            <td>
               <div name="flats{{$info->id}}" id="flats{{$info->id}}">
                  @if (@isset($info->appartment_no) && !@empty($info->appartment_no) && $info->appartment_no !=0 )
                  <select  name="flats" id="flats" class="form-control select2" driver_id_value="{{$info->id}}">
                     <option  value="0">Outside the building  </option>
                     @if (@isset($info->Flats) && !@empty($info->Flats))
                     @foreach ($flats as $info2 )
                     <option @if(old('flats',$info->Flats->flat_No)==$info2->flat_No) selected="selected" @endif value="{{ $info2->id }}"> {{"flat No:".$info2->flat_No}} </option>
                     @endforeach
                     @endif
                  </select>
                  @else
                  <select   class="form-control select2">
                     <option  value="">Select the building first.  </option>
                     {{-- <option  value=""> الشقة  </option>
                     @if (@isset($flats) && !@empty($flats))
                     @foreach ($flats as $info )
                     <option  value="{{ $info->bulding_no }}"> {{ $info->flat_No }} </option>
                     @endforeach
                     @endif
                     <option  value="0">خارج المبنى  </option> --}}
                  </select>

                  @endif
             
               </div>
              </td>


            {{-- <td 
            @if ($info->uniform_status==0) class="text-danger" @else class="text-success"  @endif > 
            @if ($info->uniform_status==0) لم يتم اي اجراء 
            @elseif ($info->uniform_status==1) تم قياس الزي الرسمي ولم يتم السليم   
            @else تم تسليم الزي الرسمي للسائق   
            @endif
            </td> --}}


            {{-- <td>
               <select  name="uniform_status" id="uniform_status" class="form-control" driver_id_value="{{$info->id}}">
                  <option   @if(old('uniform_status',$info->uniform_status)==0) selected @endif  value="0">لم يتم اي اجراء</option>
                  <option   @if(old('uniform_status',$info->uniform_status)==1) selected @endif  value="1">   تم قياس الزي الرسمي ولم يتم السليم     </option>
                  <option @if(old('uniform_status',$info->uniform_status)==2) selected @endif value="2"> تم تسليم الزي الرسمي للسائق </option>
               </select>
              </td>
           --}}

      
         <td>
            <a  href="{{ route('Housing.edit',$info->id) }}" class="btn  btn-sm" style="color:white;background-color: #EF4C2B">{{ __('mycustom.update_driver_data') }}</a>
            {{-- <a  href="{{ route('Religions.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
         </td>
      </tr>
      @endforeach
   </tbody>
</table>
</section>
<br>
<div class="col-md-12 text-center" id="ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
