@if(@isset($data) and !@empty($data) and count($data)>0 )
         
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>     الإسم </th>
      <th>      التأريخ </th>
      <th>    ملاحظات    </th>
      <th>    حالة التقرير    </th>
     
      {{-- <th></th> --}}
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         <td style="background-color: CornflowerBlue;color:white">{{ $info->added->name }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
         <td>{{ $info->date }}</td>

         <td>{{ $info->note }}</td>

         <td> 
            <select    name="report_status" id="report_status" report_id_value="{{ $info->id }}" class="form-control">
            <option  @if(old('report_status',$info->report_status)==0) selected  @endif  value="0">لم تتم المراجعة   </option>
            <option @if(old('report_status',$info->report_status)==1) selected @endif  value="1"> تمت المراجعة</option>
            </select>
         </td> 

      



         {{-- <td>
            <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">عرض الملاحظة</a>
         </td> --}}
         
      </tr>

          {{-- //////////////////////////////////////////////////////////// --}}
          <tr>
            <td colspan="7">

               {{-- <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
                  <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
               </p> --}}
               
               @foreach ( $dailyDrivingReportDrivers as $dailyDriversVal )

               @if(@isset($dailyDrivingReportDrivers) and !@empty($dailyDrivingReportDrivers) and $dailyDriversVal['daily_driving_report_id'] ==  $info->id )
            <table class="table table-bordered table-hover">
               <thead class="" style="background-color: purple;color:white">
                  <th>     المتدرب </th>
                  <th>      تقييم المتدرب </th>
                  <th>    ملاحظات المتدرب       </th>
               </thead>
               <tbody>
         
                  {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                  <tr>
                     <td style="background-color: brown;color:white">{{ $dailyDriversVal->driver->driver_name }}</td>

                     <td 
                     @if ($dailyDriversVal->driver_range==5) class="text-danger" @else class="text-success"  @endif >
                     @if ($dailyDriversVal->driver_range==5) سيئ جدا  
                     @elseif ($dailyDriversVal->driver_range==1) ممتاز  
                     @elseif ($dailyDriversVal->driver_range==2) جيد جدا  
                     @elseif ($dailyDriversVal->driver_range==3) مقبول  
                     @elseif ($dailyDriversVal->driver_range==4) سيئ  
                    
                     @endif
                     </td>

                     {{-- <td> 
                        <select    name="driving_traning_range" id="driving_traning_range" driver_id_value="{{ $info->id }}" class="form-control">
                        <option  @if(old('driving_traning_range',$info->driving_traning_range)==0) selected  @endif  value="0">لم يبداء</option>
                        <option @if(old('driving_traning_range',$info->driving_traning_range)==1) selected @endif  value="1">ممتاز</option>
                        <option @if(old('driving_traning_range',$info->driving_traning_range)==2 ) selected @endif value="2">جيد جدا</option>
                        <option @if(old('driving_traning_range',$info->driving_traning_range)==3 ) selected @endif value="3">مقبول</option>
                        <option @if(old('driving_traning_range',$info->driving_traning_range)==4 ) selected @endif value="4">سيئ</option>
                        <option @if(old('driving_traning_range',$info->driving_traning_range)==5 ) selected @endif value="5">سيئ جدا </option>
                        </select>
                     </td>  --}}

                     <td>{{ $dailyDriversVal->driver_note }}</td>
                     
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
<p class="bg-danger text-center"> عفوا لاتوجد تقارير لهذا اليوم</p>
@endif
