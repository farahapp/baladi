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