@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection

@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('contentheader')
الأدوار
@endsection
@section('contentheaderactivelink')
<a href="{{ route('permission_roles.index') }}">   أدوار  المستخدمين</a>
@endsection
@section('contentheaderactive')
عرض التفاصيل
@endsection
@section('content')
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">تفاصيل دور الصلاحية  </h3>
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            <input type="hidden" id="ajax_search_load_add_permission_roles_sub_menu" value="{{route('permission_roles.load_add_permission_roles_sub_menu')}}">
            <input type="hidden" id="ajax_search_load_add_permission_roles_sub_menues_action" value="{{route('permission_roles.load_add_permission_roles_sub_menues_action')}}">
            
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">اسم الدور</td>
                  <td > {{ $data['name'] }}</td>
               </tr>

               <tr>
                  <td class="width30">حالة تفعيل الدور</td>
                  <td > @if($data['active']==1) مفعل  @else معطل @endif</td>
               </tr>
               <tr>
                  <td class="width30">  تاريخ  الاضافة</td>
                  <td > 
                     @php
                     $dt=new DateTime($data['created_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}
                     بواسطة 
                     {{ $data->added->name }}
                  </td>
               </tr>
               <tr>
                  <td class="width30">  تاريخ التحديث</td>
                  <td > 
                     @if($data['updated_by']>0 and $data['updated_by']!=null )
                     @php
                     $dt=new DateTime($data['updated_at']);
                     $date=$dt->format("Y-m-d");
                     $time=$dt->format("h:i");
                     $newDateTime=date("A",strtotime($time));
                     $newDateTimeType= (($newDateTime=='AM'||$newDateTime=='am')?'صباحا ':'مساء'); 
                     @endphp
                     {{ $date }}
                     {{ $time }}
                     {{ $newDateTimeType }}
                     بواسطة 
                     
                     {{ $data->added->name }}
                     @else
                     لايوجد تحديث
                     @endif
                     <a href="{{ route('permission_roles.edit',$data['id']) }}" class="btn btn-sm btn-success">تعديل</a>
                     <a href="{{ route('permission_roles.index') }}" class="btn btn-sm btn-info">عودة</a>
                  </td>
               </tr>
            </table>
            <!--  treasuries_delivery   -->
            <div class="card-header">
               <h3 class="card-title card_title_center"> القوائم الرئيسية المضافة لصلاحية الدور  ( {{ $data['name'] }} )  
                  <button  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Add_permission_main_menuesModal" >اضافة قائمة</button>
               </h3>
            </div>
            <div id="ajax_responce_serarchDiv">
               @if (@isset($permission_roles_main_menues) && !@empty($permission_roles_main_menues) && count($permission_roles_main_menues) >0)

                     @foreach ($permission_roles_main_menues as $info )
                     <table id="example2" class="table table-bordered table-hover">
                        <thead class="custom_thead">
                           <th>اسم القائمة الرئيسية</th>
                           <th>تاريخ الاضافة</th>
                           <th></th>
                        </thead>
                        <tbody>

                     <tr>
                        <td>{{ $info->permission_main_menues->name }}</td>
                        <td > 
                           @php
                           $dt=new DateTime($info->created_at);
                           $date=$dt->format("Y-m-d");
                           $time=$dt->format("h:i");
                           $newDateTime=date("A",strtotime($time));
                           $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                           @endphp
                           {{ $date }}
                           {{ $time }}
                           {{ $newDateTimeType }}
                           بواسطة 
                           {{ $info->permission_roles->added->name}}
                        </td>
                        <td>
                           <a href="{{ route('permission_roles.delete_permission_main_menues',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
                        </td>
                     </tr>
                     <tr>
                        <td colspan="3">
                           <p style="text-align: center;font-size: 1.4vw; color:brown">القوائم الفرعية المضافة لهذه القائمة الرئيسية
                              <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_permission_roles_sub_menu btn-info" >اضافة قائمة فرعية</button>
                           </p>

                           {{-- ====================(بيانات الطريقة القديمة المتخلفة)================== --}}
                           @foreach ($permission_sub_menues_nameData as $sub )
                           @if (@isset($permission_sub_menues_nameData) && !@empty($permission_sub_menues_nameData)  &&  $sub['permission_roles_main_menus_id'] == $info->id )
                           <table id="example2" class="table table-bordered table-hover ">
                              <thead class="custom_thead" style="background-color: purple;color:white">
                                 <th>اسم القائمة الفرعية</th>
                                 <th>تاريخ الاضافة</th>
                                 <th></th>
                              </thead>
                              <tbody>
                                 {{-- @foreach ($permission_sub_menues_nameData as $sub ) --}}
                                 <tr>
                                    <td>{{ $sub->permission_sub_menues->name}}</td>
                                    <td > 
                                       @php
                                       $dt=new DateTime($sub->created_at);
                                       $date=$dt->format("Y-m-d");
                                       $time=$dt->format("h:i");
                                       $newDateTime=date("A",strtotime($time));
                                       $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
                                       @endphp
                                       {{ $date }}
                                       {{ $time }}
                                       {{ $newDateTimeType }}
                                       بواسطة 
                                       {{ $sub->added->name}}
                                    </td>
                                    <td>
                                       <button data-id="{{ $sub->id }}"  class="btn btn-sm load_add_permission_roles_sub_menues_actions btn-info" >اضافة صلاحيات مباشرة </button>
                                       <a href="{{ route('permission_roles.delete_permission_sub_menues',$sub->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td  colspan="3" style="text-align: center">
                                    @foreach ($permission_roles_sub_menu_action as $action )
                                    @if (@isset($permission_roles_sub_menu_action) && !@empty($permission_roles_sub_menu_action)  &&  $action->permission_roles_sub_menu_id == $sub->id )
                                    <a href="{{ route('permission_roles.delete_permission_sub_menues_actions',$action->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">{{ $action->permission_sub_menues_actions->name }}<i class="fa fa-trash " aria-hidden="true"></i></a>

                                   {{-- @php
                                    echo ". ."
                                    @endphp --}}
                                    @endif
                                    @endforeach
                                 </td>
                                 </tr><br>
         

                              </tbody>
                              </table>

                           @else
                           {{-- <div class="alert alert-danger">
                              عفوا لاتوجد بيانات لعرضها !!
                           </div> --}}
                           @endif
                           @endforeach
                          {{-- ====================(بيانات الطريقة القديمة المتخلفة)================== --}}

                        </td>
                     </tr>
                  </tbody>
               </table>
                     @endforeach
           
               @else
               <div class="alert alert-danger">
                  عفوا لاتوجد بيانات لعرضها !!
               </div>
               @endif
            </div>
            <!--  End treasuries_delivery   -->
            @else
            <div class="alert alert-danger">
               عفوا لاتوجد بيانات لعرضها !!
            </div>
            @endif
         </div>
   </div>
</div>
{{-- ===================================================== --}}
<div class="modal fade  "   id="Add_permission_main_menuesModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة قائمة رئيسية للدور</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body"  style="background-color: white !important; color:black;">
            <form action="{{ route('permission_roles.Add_permission_main_menues',$data['id']) }}" method="post">
               @csrf
           
               <div class="col-md-12">
                  <div class="form-group">
                      <label>   القائمة الرئيسية </label>
                        <select required name="permission_main_menues_id[]" multiple id="permission_main_menues_id" class="form-control select2 ">
                           <option  value="">اختر القائمة الرئيسية</option>
                           @if (@isset($Permission_main_menues) && !@empty($Permission_main_menues))
                           @foreach ($Permission_main_menues as $info )
                           <option @if(old('permission_main_menues_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                           @endforeach
                           @endif
                        </select>
                        @error('permission_main_menues_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                  </div>
               </div>

               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit"> اضافة </button>
                  <a href="{{ route('permission_roles.index') }}" class="btn btn-danger btn-sm">الغاء</a>
               </div>

            </form>
         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
{{-- ===================================================== --}}

{{-- ===================================================== --}}
<div class="modal fade  "   id="load_add_permission_roles_sub_menuModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة قائمة فرعية للقائمة الرئسية</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" id="load_add_permission_roles_sub_menuModalBody"  style="background-color: white !important; color:black;">


         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
{{-- ===================================================== --}}
{{-- ===================================================== --}}
<div class="modal fade  "   id="load_add_permission_roles_sub_menues_actionModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة صلاحيات مباشرة للقائمة الفرعية</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body" style="background-color: white !important; color:black;" id="load_add_permission_roles_sub_menues_actionModalBody">


         </div>
         <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">اغلاق</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
{{-- ===================================================== --}}
@endsection
{{-- ===================================================== --}}
@section("script")
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ secure_asset('assets/admin/js/permission_roles.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection
{{-- ===================================================== --}}