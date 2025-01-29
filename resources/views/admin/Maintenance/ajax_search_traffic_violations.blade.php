@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>    رقم اللوحة </th>
      {{-- <th>    نوع المركبة  </th> --}}
      <th>    سائق المركبة  </th>
      <th>   نوع المركبة</th>
      <th>     طراز المركبة </th>
      <th>   حالة المركبة</th>
      {{-- <th>  الاضافة بواسطة</th>
      <th>  التحديث بواسطة</th> --}}
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td style="background-color: aquamarine">{{ $info->vechile_no }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
          {{-- @if ($info->vechile_driver==null||$info->vechile_driver =='') --}}
          @if (@isset($info->vechile_driver) && !@empty($info->vechile_driver))
          <td>{{ $info->VechileDriver->driver_name }} </td>
          @else
          <td>لايوجد </td>
          @endif
          <td @if ($info->vechile_car_or_bike==1) class="text-success" @else class="text-danger"  @endif > @if ($info->vechile_car_or_bike==1) سيارة @else دراجة نارية  @endif</td>
          <td>{{ $info->Vechile_Model->name }}</td>
          <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) تعمل @elseif ($info->vechile_status==0) متعطلة @else داخل الصيانة @endif</td>
         {{-- <td>
            <a  href="{{ route('Maintenance.edit_bike',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
            <a href="{{ route('Maintenance.destroy',$info->id) }}" class="btn btn-sm btn-danger are_you_shur">حذف</a>
         </td> --}}
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}
      <tr>
         <td colspan="7">

            <p style="text-align: center;font-size: 1.4vw; color:brown">المخالفات المرورية لهذه المركبة 
               <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_traffic_violation btn-info" >اضافة مخالفة للمركبة</button>
            </p>
            
            @foreach ( $vechile_Traffic_Violations as $traffic_ViolationVal )

            @if(@isset($vechile_Traffic_Violations) and !@empty($vechile_Traffic_Violations) and $traffic_ViolationVal['vechile_id'] ==  $info->id )
         <table class="table table-bordered table-hover">
            <thead class="" style="background-color: purple;color:white">
               <th>    اسم المخالفة المرورية </th>
               {{-- <th>   القائمة الرئيسية</th> --}}
               <th>   قيمة المخالفة </th>
               <th>  تاريخ المخالفة </th>
               <th>   حالة سداد المخالفة </th>
               <th></th>
            </thead>
            <tbody>
      
               {{-- @foreach ( $dataSub_menueAction as $action ) --}}
               <tr>
                  <td style="background-color: brown;color:white">{{ $traffic_ViolationVal->traffic_violation_name }}</td>
                  <td>{{ $traffic_ViolationVal->traffic_violation_amount."ريال"}}</td>
                  <td>{{ $traffic_ViolationVal->date }}</td>
                  <td>{{ $traffic_ViolationVal->traffic_violation_payment_status }}</td>
                  {{-- <td>{{ $actionVal->name }}</td> --}}
                  
                  <td>
                     <button data-id="{{ $traffic_ViolationVal->id }}" class="btn btn-sm btn-info load_edit_permission_btn">تعديل</button>
                     <a href="{{ route('Maintenance.delete_maintenance_to_vehicle',$traffic_ViolationVal->id) }}" class="btn btn-sm  are_you_shur" style="background-color: purple;color:white">حذف</a>

                  </td>
               </tr>

            </tr>

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