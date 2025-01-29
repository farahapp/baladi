@extends('layouts.admin')
@section('title')
 البرنامج التدريبي
@endsection
@section('contentheader')
المتدربين 
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection
@section('contentheaderactivelink')
<a href="{{ route('Training.index') }}">     السائقين</a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">{{ __('mycustom.drivers_information') }} 
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('Training.ajax_search')}}">   
            <input type="hidden" id="ajax_update_english_group" value="{{route('Training.ajax_update_english_group')}}">
            <input type="hidden" id="ajax_update_english_lectures_atendence_range" value="{{route('Training.ajax_update_english_lectures_atendence_range')}}">
            <input type="hidden" id="ajax_update_english_lectures_understand_range" value="{{route('Training.ajax_update_english_lectures_understand_range')}}">
            <input type="hidden" id="ajax_update_talabat_lectures_atendence_range" value="{{route('Training.ajax_update_talabat_lectures_atendence_range')}}">
            <input type="hidden" id="ajax_update_talabat_lectures_understand_range" value="{{route('Training.ajax_update_talabat_lectures_understand_range')}}">
            <input type="hidden" id="ajax_update_atucate_lectures_atendence_range" value="{{route('Training.ajax_update_atucate_lectures_atendence_range')}}">
            <input type="hidden" id="ajax_atucate_lectures_understand_range" value="{{route('Training.ajax_atucate_lectures_understand_range')}}">
         </h3>
      </div>

      

      <div class="row">

         <div class="col-md-3">
            <div class="form-group">
            <input checked type="radio" name="searchbyradio" value="name"> بالإسم
            <input type="radio" name="searchbyradio" id="searchbyradio" value="id_number"> بالاقامة
            <input type="radio" name="searchbyradio" id="searchbyradio" value="phone_number"> بالهاتف

            <input  autofocus style="margin-top 6px !important;" type="text" id="search_by_text" placeholder="" class="form-control">
         </div>
      </div>

      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(22)==true)
      <div class="col-md-3">
         <div class="form-group">
            <label>       مجموعة الانجليزي    </label>
            <select    name="english_group_Search" id="english_group_Search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يبداء</option>
            <option  value="3">A</option>
            <option  value="2">B</option>
            <option  value="1">C</option>
            </select>
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-3">
         <div class="form-group">
            <label>       حضور الانجليزي    </label>
            <select    name="english_lectures_atendence_range_Search" id="english_lectures_atendence_range_Search" class="form-control">
            <option  value="all">البحث بالكل </option>
            <option  value="0">لم يبداء</option>
            <option  value="1">ممتاز</option>
            <option  value="2">جيد جدا</option>
            <option  value="3">مقبول</option>
            <option  value="4">سيئ</option>
            <option  value="5">سيئ جدا </option>
            </select>
         </div>
      </div>
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      <div class="col-md-3">
         <div class="form-group">
            <label>       إستيعاب الانجليزي    </label>
            <select  name="english_lectures_understand_range_Search" id="english_lectures_understand_range_Search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="0">لم يبداء</option>
               <option  value="1">ممتاز</option>
               <option  value="2">جيد جدا</option>
               <option  value="3">مقبول</option>
               <option  value="4">سيئ</option>
               <option  value="5">سيئ جدا </option>
             </select>
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(23)==true)
      <div class="col-md-3">
         <div class="form-group">
            <label>       حضور طلبات    </label>
            <select  name="talabat_lectures_atendence_range_Search" id="talabat_lectures_atendence_range_Search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="0">لم يبداء</option>
               <option  value="1">ممتاز</option>
               <option  value="2">جيد جدا</option>
               <option  value="3">مقبول</option>
               <option  value="4">سيئ</option>
               <option  value="5">سيئ جدا </option>
            </select>
         </div>
      </div>
       {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
       <div class="col-md-3">
         <div class="form-group">
            <label>       إستيعاب طلبات    </label>
            <select  name="talabat_lectures_understand_range_Search" id="talabat_lectures_understand_range_Search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="0">لم يبداء</option>
               <option  value="1">ممتاز</option>
               <option  value="2">جيد جدا</option>
               <option  value="3">مقبول</option>
               <option  value="4">سيئ</option>
               <option  value="5">سيئ جدا </option>
            </select>
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
      @if (auth()->user()->is_master_Admin==1 ||check_permission_sub_menue_actions(24)==true)
      <div class="col-md-3">
         <div class="form-group">
            <label>        حضور  الاتكيت </label>
            <select  name="atucate_lectures_atendence_range_Search" id="atucate_lectures_atendence_range_Search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="0">لم يبداء</option>
               <option  value="1">ممتاز</option>
               <option  value="2">جيد جدا</option>
               <option  value="3">مقبول</option>
               <option  value="4">سيئ</option>
               <option  value="5">سيئ جدا </option>
            </select>
         </div>
      </div>
            {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}
         <div class="col-md-3">
         <div class="form-group">
            <label>        إستيعاب  الاتكيت </label>
            <select  name="atucate_lectures_understand_range_Search" id="atucate_lectures_understand_range_Search" class="form-control">
               <option  value="all">البحث بالكل </option>
               <option  value="0">لم يبداء</option>
               <option  value="1">ممتاز</option>
               <option  value="2">جيد جدا</option>
               <option  value="3">مقبول</option>
               <option  value="4">سيئ</option>
               <option  value="5">سيئ جدا </option>
            </select>
         </div>
      </div>
      @endif
      {{-- ////////////////////////////////////////////////////////////////////////////////////////////////////////////// --}}

      
      </div>



      <div class="card-body" id="training_ajax_responce_serachDiv">
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

@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script src="{{ asset('/../assets/admin/js/training.js') }}"></script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });


   $(document).on('change','#english_group', function(e){
      var english_group = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_english_group").val();
      if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         english_group: english_group,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
        // alert("Updated successfully");
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
   //  else{
   //    alertify.set('notifier','position','top-right');
   //       alertify.success("يجب تسليم الجواز وتوقيع جميع العقود ");
   //  }

});



$(document).on('change','#english_lectures_atendence_range', function(e){
      var english_lectures_atendence_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_english_lectures_atendence_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         english_lectures_atendence_range: english_lectures_atendence_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});



$(document).on('change','#english_lectures_understand_range', function(e){
      var english_lectures_understand_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_english_lectures_understand_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         english_lectures_understand_range: english_lectures_understand_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});



$(document).on('change','#talabat_lectures_atendence_range', function(e){
      var talabat_lectures_atendence_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_talabat_lectures_atendence_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         talabat_lectures_atendence_range: talabat_lectures_atendence_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});



$(document).on('change','#talabat_lectures_understand_range', function(e){
      var talabat_lectures_understand_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_talabat_lectures_understand_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         talabat_lectures_understand_range: talabat_lectures_understand_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});



$(document).on('change','#atucate_lectures_atendence_range', function(e){
      var atucate_lectures_atendence_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_update_atucate_lectures_atendence_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         atucate_lectures_atendence_range: atucate_lectures_atendence_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});


$(document).on('change','#atucate_lectures_understand_range', function(e){
      var atucate_lectures_understand_range = $(this).val();
      var driver_id_value=$(this).attr("driver_id_value");
      var isGivePassPort=$(this).attr("isGivePassPort");
      var isSigningMainContract=$(this).attr("isSigningMainContract");
      var isSigningFullFinancialDebt=$(this).attr("isSigningFullFinancialDebt");
      var isSigningPenaltyClause=$(this).attr("isSigningPenaltyClause");
var token_search = $("#token_search").val();
    var ajax_url = $("#ajax_atucate_lectures_understand_range").val();
    if(isGivePassPort=="0"||isSigningMainContract=="0"
       ||isSigningFullFinancialDebt=="0"||isSigningPenaltyClause=="0"){
      alertify.set('notifier','position','top-right');
      alertify.alert(" يجب تسليم الجواز وتوقيع جميع العقود والمديونيات");
}else{
   jQuery.ajax({
        url: ajax_url,
        type: 'post',
        dataType: 'html',
        cache: false,
        data: {
         atucate_lectures_understand_range: atucate_lectures_understand_range,
         driver_id_value: driver_id_value,
            "_token": token_search
        },
        success: function(data) {
          
         alertify.set('notifier','position','top-right');
         alertify.success("Updated successfully");

           $('.select2').select2({
            theme: 'bootstrap4'
          });
        },
        error: function(){
            alert("عفوا حدث خطا ما !");
        }
    });
   }
});


</script>
@endsection
