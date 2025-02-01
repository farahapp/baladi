@extends('layouts.admin')
@section('title')
الصلاحيات
@endsection
@section('contentheader')
المستخدمين
@endsection
@section('contentheaderactivelink')
<a href="{{ route('admins_accounts.index') }}">   القوائم الفرعية  </a>
@endsection
@section('contentheaderactive')
 التفاصيل
@endsection

@section("css")
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
   <div class="col-12">
      <div class="card">
         <div class="card-header">
            <h3 class="card-title card_title_center">تفاصيل الصلاحيات الخاصة للمستخدم   </h3>
            <input type="hidden" id="token_search" value="{{csrf_token()}}">
            
         </div>
         <!-- /.card-header -->
         <div class="card-body">
            @if (@isset($data) && !@empty($data))
            <table id="example2" class="table table-bordered table-hover">
               <tr>
                  <td class="width30">اسم المستخدم</td>
                  <td > {{ $data['name'] }}</td>
               </tr>

               <tr>
                  <td class="width30">نوع صلاحية دور المستخدم</td>
                  <td > {{ $data->permission_rols->name}}</td>
               </tr>

               <tr>
                  <td class="width30">البريد الالكتروني </td>
                  <td > {{ $data['email']}}</td>
               </tr>

               <tr>
                  <td class="width30">حالة تفعيل المستخدم</td>
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
                     <a href="{{ route('admins_accounts.edit',$data['id']) }}" class="btn btn-sm btn-success">تعديل</a>
                     <a href="{{ route('admins_accounts.index') }}" class="btn btn-sm btn-info">عودة</a>
                  </td>
               </tr>
            </table>
            <!--  admin_permission_to_employees   -->
            <div style="background-color: firebrick;color:white" class="card-header">
               <h3 class="card-title card_title_center"> صلاحيات {{ $data['name'] }} على السائقين والموظفين    
                  <button  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Add_employeesModal" >اضافة صلاحيات على السائقين</button>
               </h3>
            </div>
            <div id="ajax_responce_serarchDiv">
               @if (@isset($admin_permission_to_employees) && !@empty($admin_permission_to_employees) && count($admin_permission_to_employees) >0)

               <table id="example2" class="table table-bordered table-hover">
                  <thead class="custom_thead">
                     <th>اسم السائق </th>
                     <th>تاريخ الاضافة</th>
                     <th></th>
                  </thead>
                  <tbody>
                     @foreach ($admin_permission_to_employees as $info )
                     

                     <tr>
                        <td>{{ $info->admin->name }}</td>
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
                           {{ $info->added->name}}
                        </td>
                        <td>
                           <a href="{{ route('admins_accounts.destroy_admin_permission_to_employees',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
                        </td>
                     </tr>
                    
                 
                     @endforeach
                  </tbody>
               </table>
           
               @else
               <div class="alert alert-danger">
                  عفوا لاتوجد بيانات لعرضها !!
               </div>
               @endif
            </div>
            <!--  End admin_permission_to_employees   -->
            @else
            <div class="alert alert-danger">
               عفوا لاتوجد بيانات لعرضها !!
            </div>
            @endif

                        <!--  admin_permission_to_jobs_categories   -->
                        <div style="background-color: firebrick;color:white" class="card-header">
                           <h3  class="card-title card_title_center"> صلاحيات {{ $data['name'] }} على انواع الوظائف     
                              <button  class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Add_jobs_categoriesModal" >اضافة صلاحيات على انواع الوظائف</button>
                           </h3>
                        </div>
                        <div id="ajax_responce_serarchDiv">
                           @if (@isset($Admin_permission_to_jobs_categorie) && !@empty($Admin_permission_to_jobs_categorie) && count($Admin_permission_to_jobs_categorie) >0)
            
                           <table id="example2" class="table table-bordered table-hover">
                              <thead class="custom_thead">
                                 <th>اسم الوظيفة </th>
                                 <th>تاريخ الاضافة</th>
                                 <th></th>
                              </thead>
                              <tbody>
                                 @foreach ($Admin_permission_to_jobs_categorie as $info )
                                 
            
                                 <tr>
                                    <td>{{ $info->jobs_categories->name }}</td>
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
                                       {{ $info->added->name}}
                                    </td>
                                    <td>
                                       <a href="{{ route('admins_accounts.destroy_admin_permission_to_jobs_categories',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
                                    </td>
                                 </tr>
                                
                             
                                 @endforeach
                              </tbody>
                           </table>
                       
                           @else
                           <div class="alert alert-danger">
                              عفوا لاتوجد بيانات لعرضها !!
                           </div>
                        </div>
                        @endif

                        <!--  End admin_permission_to_jobs_categories   -->
                      
         </div>
   </div>
</div>

{{-- ===================================================== --}}

{{-- ===================================================== --}}
<div class="modal fade  "   id="Add_employeesModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة سائق لصلاحية المستخدم   </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body"  style="background-color: white !important; color:black;">
            <form action="{{ route('admins_accounts.add_employees',$data['id']) }}" method="post">
               @csrf
               <div class="col-md-12">
                  <div class="form-group">
                      <label>   بيانات السائقين  </label>
                        <select required oninvalid="setCustomValidity('من فضلك أدخل اختار السائقين')" onchange="try{setCustomValidity('')catch(e){}}" name="employees_ids[]" multiple id="employees_ids" class="form-control select2 ">
                           <option  value="" >اختر السائقين </option>
                           @if (@isset($employees) && !@empty($employees))
                           @foreach ($employees as $info )
                           <option @if(old('employees_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
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
                  <a href="{{ route('admins_accounts.details',$data['id']) }}" class="btn btn-danger btn-sm">الغاء</a>
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
<div class="modal fade  "   id="Add_jobs_categoriesModal">
   <div class="modal-dialog modal-xl"  >
      <div class="modal-content bg-info">
         <div class="modal-header">
            <h4 class="modal-title text-center">            إضافة نوع وظيفة لصلاحية المستخدم   </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body"  style="background-color: white !important; color:black;">
            <form action="{{ route('admins_accounts.add_jobs_categories',$data['id']) }}" method="post">
               @csrf
               <div class="col-md-12">
                  <div class="form-group">
                      <label>   بيانات السائقين  </label>
                        <select name="jobs_categories_ids[]" multiple id="jobs_categories_ids" class="form-control select2 "  required oninvalid="setCustomValidity('من فضلك أدخل اختار السائقين')" onchange="try{setCustomValidity('')catch(e){}}">
                           <option  value="" >اختر السائقين </option>
                           @if (@isset($jobs_categories) && !@empty($jobs_categories))
                           @foreach ($jobs_categories as $info )
                           <option @if(old('jobs_categories_id')==$info->id) selected="selected" @endif value="{{ $info->id }}"> {{ $info->name }} </option>
                           @endforeach
                           @endif
                        </select>
                  </div>
               </div>
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-success" type="submit" name="submit"> اضافة </button>
                  <a href="{{ route('admins_accounts.details',$data['id']) }}" class="btn btn-danger btn-sm">الغاء</a>
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
{{-- ===================================================== --}}
@endsection
{{-- ===================================================== --}}
@section("script")
<script  src="{{ asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script  src="{{ asset('assets/admin/js/admins.js') }}"> </script>
<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });
</script>
@endsection
{{-- ===================================================== --}}