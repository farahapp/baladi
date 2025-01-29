@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection
@section('contentheader')
صلاحيات القوائم الفرعية
@endsection
@section('contentheaderactivelink')
<a href="{{ route('permission_sub_menues.index') }}">   القوائم الفرعية  </a>
@endsection
@section('contentheaderactive')
عرض
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  بيانات القوائم الفرعية للصلاحيات 
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_url" value="{{route('permission_sub_menues.ajax_search')}}">
            <input type="hidden" id="ajax_do_add_permission" value="{{route('permission_sub_menues.ajax_do_add_permission')}}">
            <input type="hidden" id="ajax_load_edit_permission" value="{{route('permission_sub_menues.ajax_load_edit_permission')}}">
            <input type="hidden" id="ajax_do_edit_permission" value="{{route('permission_sub_menues.ajax_do_edit_permission')}}">
            <input type="hidden" id="ajax_do_delete_permission" value="{{route('permission_sub_menues.ajax_do_delete_permission')}}">
            <a href="{{ route('permission_sub_menues.create') }}" class="btn btn-sm btn-warning">اضافة جديد</a>
         </h3>
      </div>

      <div class="row" style="padding: 5px;">

         <div class="col-md-3">
            <div class="form-group">
               <label>  بحث بالأسم </label>
               <input type="text"  autofocus id="search_by_text" class="form-control" value="" placeholder="بحث بالاسم">
            </div>
         </div>

         <div class="col-md-3">
            <div class="form-group">
               <label> البحث بالقوائم الرئيسية </label>
               <select name="permission_main_menues_id_search" id="permission_main_menues_id_search" class="form-control select2 ">
                  <option  value="all">البحث بالكل </option>
                  @if (@isset($Permission_main_menuesData) && !@empty($Permission_main_menuesData))
                  @foreach ($Permission_main_menuesData as $info )
                  <option @if(old('permission_main_menues_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                  @endforeach
                  @endif
               </select>
            </div>
         </div>
        

      </div>

      <div class="card-body" id="Permission_sub_menues_ajax_serachDiv">
         @if(@isset($data) and !@empty($data) and count($data)>0 )
         
         <table id="example2" class="table table-bordered table-hover">
            <thead class="custom_thead">
               <th>    القائمة الفرعية</th>
               <th>   القائمة الرئيسية</th>
               <th>   حالة التفعيل</th>
               <th>  الاضافة بواسطة</th>
               <th>  التحديث بواسطة</th>
               <th></th>
            </thead>
            <tbody>
               @foreach ( $data as $info )
               <tr>
                  <td style="background-color: aquamarine">{{ $info->name }}</td>
                  <td>{{ $info->main_menue->name }}</td>
                  <td @if ($info->active==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->active==1) مفعل @else معطل @endif</td>
                  <td>
                     @php
                     $dt=new DateTime($info->created_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("a",strtotime($info->created_at));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }} <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->added->name }} 
                  </td>
                  <td>
                     @if($info->updated_by>0)
                     @php
                     $dt=new DateTime($info->updated_at);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("a",strtotime($info->updated_at));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}  <br>
                     {{ $time }}
                     {{ $newDateTimeType }}  <br>
                     {{ $info->updatedby->name }} 
                     @else
                     لايوجد
                     @endif
                  </td>
                  <td>
                     <a  href="{{ route('permission_sub_menues.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                     <button data-id="{{ $info->id }}" class="btn btn-sm btn-success load_add_permission_btn">إضافة صلاحيات</button><br/>
                     <a  href="{{ route('permission_sub_menues.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a>

                  </td>
               </tr>

               <tr>
                  <td colspan="6">
                     @foreach ( $dataSub_menueAction as $actionVal )

                     @if(@isset($dataSub_menueAction) and !@empty($dataSub_menueAction) and $actionVal['permission_sub_menues_id'] ==  $info->id )
                  <table class="table table-bordered table-hover">
                     <thead class="" style="background-color: lightslategray;color:white">
                        <th>    اسم الصلاحية </th>
                        {{-- <th>   القائمة الرئيسية</th> --}}
                        <th>  الاضافة بواسطة</th>
                        <th>  التحديث بواسطة</th>
                        <th></th>
                     </thead>
                     <tbody>
               
                        {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                        <tr>
                           <td style="background-color: gray">{{ $actionVal->name }}</td>
                           {{-- <td>{{ $actionVal->name }}</td> --}}
                           <td>
                              @php
                              $dt=new DateTime($actionVal->created_at);
                              $date=$dt->format("Y-m-d");
                              $time=$dt->format("h:i");
                              $newDateTime=date("a",strtotime($actionVal->created_at));
                              $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                              @endphp
                              {{ $date }} <br>
                              {{ $time }}
                              {{ $newDateTimeType }}  <br>
                              {{ $actionVal->added->name }} 
                           </td>
                           <td>
                              @if($actionVal->updated_by>0)
                              @php
                              $dt=new DateTime($actionVal->updated_at);
                              $date=$dt->format("Y-m-d");
                              $time=$dt->format("h:i");
                              $newDateTime=date("a",strtotime($actionVal->updated_at));
                              $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                              @endphp
                              {{ $date }}  <br>
                              {{ $time }}
                              {{ $newDateTimeType }}  <br>
                              {{ $actionVal->updatedby->name }} 
                              @else
                              لايوجد
                              @endif
                           </td>
                           <td>
                              <button data-id="{{ $actionVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">تعديل</button>
                              <button data-id="{{ $actionVal->id }}" class="btn btn-sm btn-danger do_delete_permission_btn">حذف</button>
                              {{-- <a  href="{{ route('permission_sub_menues.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                           </td>
                        </tr>
                        {{-- @endforeach --}}

                     </tbody>
                  </table>

                  @else
                  {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
                  @endif
                  @endforeach

                     </td>
                     </tr>

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
      </div>
   </div>
</div>

{{-- ====================================================================================================== --}}
<div class="modal fade  "   id="add_permission_modal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">               اضافة صلاحية مهام </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="InvoiceModalActiveDetailsBody" style="background-color: white !important; color:black;">

         
               <div class="col-md-12">
                  <div class="form-group">
                     <label>     اسم الصلاحية </label>
                     <input  type="text" name="permission_name_modal" id="permission_name_modal" class="form-control" value="" placeholder="أدخل  اسم الصلاحية"  >
                     @error('name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
       
   
               
               <div class="col-md-12">
                  <div class="form-group text-center">
                     <button id="do_add_permission" class="btn btn-sm btn-primary" type="button"  name="submit">اضافة  </button>
                  </div>
               </div>


            </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

{{-- ====================================================================================================== --}}

{{-- ====================================================================================================== --}}
<div class="modal fade  "   id="edit_permission_modal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">               تعديل صلاحية مهام </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="edit_permission_modalBody" style="background-color: white !important; color:black;">

         
               <div class="col-md-12">
                  <div class="form-group">
                     <label>     اسم الصلاحية </label>
                     <input  type="text" name="permission_name_modal" id="permission_name_modal" class="form-control" value="" placeholder="أدخل  اسم الصلاحية"  >
                     @error('name')
                     <span class="text-danger">{{ $message }}</span> 
                     @enderror
                  </div>
               </div>
   
       
   
               
               <div class="col-md-12">
                  <div class="form-group text-center">
                     <button id="do_add_permission" class="btn btn-sm btn-primary" type="button"  name="submit">اضافة  </button>
                  </div>
               </div>


            </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

{{-- ====================================================================================================== --}}


@endsection


@section('script')
<script src="{{ asset('/../assets/admin/js/permission_sub_menues.js') }}"></script>
@endsection


