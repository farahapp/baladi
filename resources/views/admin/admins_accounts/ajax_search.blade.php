@if(@isset($data) and !@empty($data) and count($data)>0 )
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>    اسم المستخدم </th>
      <th>   نوع المستخدم </th>
      <th>   حالة التفعيل</th>
      <th>  الاضافة بواسطة</th>
      <th>  التحديث بواسطة</th>
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td style="background-color: aquamarine">{{ $info->name }}</td>
         <td>{{ $info->permission_rols->name }}</td>
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
            {{ $info->added->name }} 
            @else
            لايوجد
            @endif
         </td>
         <td>
            <a  href="{{ route('admins_accounts.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
            <a  href="{{ route('admins_accounts.details',$info->id) }}" class="btn btn-info btn-sm">صلاحيات خاصة</a>
         </td>
      </tr>
      @endforeach
   </tbody>
</table>

         <br>
         

            <div class="col-md-12 text-center" id="Admin_account_ajax_pagination_in_search">
            {{ $data->links('pagination::bootstrap-5') }}
            </div>

         @else
         <p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
         @endif