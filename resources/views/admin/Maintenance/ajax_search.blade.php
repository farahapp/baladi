@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>    رقم اللوحة </th>
      {{-- <th>    نوع المركبة  </th> --}}
      <th>     طراز المركبة </th>
      <th>    تاريخ إنتهاء الترخيص  </th>
      <th>    انتهاء التأمين  </th>
      <th>    سائق المركبة  </th>
      <th>   حالة المركبة</th>
      {{-- <th>  الاضافة بواسطة</th>
      <th>  التحديث بواسطة</th> --}}
      <th></th>
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td style="background-color: aquamarine">{{ $info->vechile_no }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
         <td>{{ $info->Vechile_Model->name }}</td>
         <td>{{ $info->vechile_end_registeration }}</td>
         <td>{{ $info->insurance_ending_date }}</td>
          {{-- @if ($info->vechile_driver==null||$info->vechile_driver =='') --}}
          @if (@isset($info->vechile_driver) && !@empty($info->vechile_driver))
          <td>{{ $info->VechileDriver->driver_name }} </td>
          @else
          <td>لايوجد </td>
          @endif
         <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) تعمل @elseif ($info->vechile_status==0) متعطلة @else داخل الصيانة @endif</td>
         {{-- <td>
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
         </td> --}}
         <td>
            <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
            <a href="{{ route('Maintenance.destroy',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
         </td>
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}
      <tr>
         <td colspan="7">

            <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
               <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
            </p>
            
            @foreach ( $vehicle_Maintenance as $maintenanceVal )

            @if(@isset($vehicle_Maintenance) and !@empty($vehicle_Maintenance) and $maintenanceVal['vehicle_id'] ==  $info->id )
         <table class="table table-bordered table-hover">
            <thead class="" style="background-color: purple;color:white">
               <th>    اسم الصيانة </th>
               {{-- <th>   القائمة الرئيسية</th> --}}
               <th>   تكلفة الصيانة الكلية</th>
               <th>    ورشة الصيانة </th>
               <th>  تاريخ الصيانة </th>
               <th></th>
            </thead>
            <tbody>
      
               {{-- @foreach ( $dataSub_menueAction as $action ) --}}
               <tr>
                  <td style="background-color: brown;color:white">{{ $maintenanceVal->name }}</td>
                  <td>{{ $maintenanceVal->total_cost."ريال"}}</td>
                  <td>{{ $maintenanceVal->workshop}}</td>
                  <td>{{ $maintenanceVal->date }}</td>
                  {{-- <td>{{ $actionVal->name }}</td> --}}
                  
                  
                  <td>
                     <button data-id="{{ $maintenanceVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">تعديل</button>
                     <a href="{{ route('Maintenance.delete_maintenance_to_vehicle',$maintenanceVal->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a>
                     {{-- <button data-id="{{ $maintenanceVal->id }}" class="btn btn-sm btn-danger do_delete_permission_btn">حذف</button> --}}
                     <button data-id="{{ $maintenanceVal->id }}"  class="btn btn-sm load_add_vechile_spare_part btn-info" style="background-color: purple;color:white">اضافة قطع غيار  </button>
                     {{-- <a href="{{ route('permission_roles.delete_permission_sub_menues',$sub->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a> --}}
                     {{-- <a  href="{{ route('permission_sub_menues.destroy',$info->id) }}" class="btn are_you_shur  btn-danger btn-sm">حذف</a> --}}
                  </td>
               </tr>

            </tr>
                {{---------------------------------------------}}
            <tr>
               <td  colspan="5" style="text-align: center">
               @foreach ($Vechile_Spare_Parts as $spare )
               @if (@isset($Vechile_Spare_Parts) && !@empty($Vechile_Spare_Parts)  &&  $spare->vechile_maintenance_id == $maintenanceVal->id )
               <a href="{{ route('Maintenance.delete_vechile_spare_part',$spare->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">{{ $spare->name."(".$spare->price." ريال)" }}<i class="fa fa-trash " aria-hidden="true"></i></a>
               @endif
               @endforeach
            </td>
            </tr>
               {{---------------------------------------------}}

            </tbody>
         </table>

         @else
         {{-- <p class="bg-danger text-center"> عفوا لاتوجد صلاحيات مضافة لعرضها</p> --}}
         @endif
         @endforeach

            </td>
            </tr>


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