@if(@isset($data) and !@empty($data) and count($data)>0 )
    
@foreach ( $data as $info )

<table id="example2">
   <thead>
      <th>Driver Name</th>
      <th>Date</th>
      <th>Notes</th>
      <th>Guard Name</th>
      <th>Deposit Status</th>
      <th></th>
   </thead>
   <tbody>
      <tr>
         <td style="background-color: CornflowerBlue;color:white">{{ $info->driver->driver_name }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
         <td>{{ $info->date }}</td>

         <td>{{ $info->note }}</td>

         <td style="background-color: CornflowerBlue;color:white">{{ $info->added->name }}</td>

         <td> 
            <select    name="report_status" id="report_status" report_id_value="{{ $info->id }}" class="form-control">
               <option  @if(old('report_status',$info->report_status)==0) selected  @endif  value="0">Not Returned Deposit </option>
               <option @if(old('report_status',$info->report_status)==1) selected @endif  value="1">Returned Deposit</option>
               </select>
         </td> 

         <td>
            <a style="color:white" class="btn btn-info btn-sm load_add_note_btn">Security guard notes </a>
         </td>

      </tr>

          {{-- //////////////////////////////////////////////////////////// --}}
          <tr>
            <td colspan="7">

               {{-- <p style="text-align: center;font-size: 1.4vw; color:brown">عمليات الصيانة التي تمت لهذه المركبة 
                  <button data-id="{{ $info->id }}"  class="btn btn-sm load_add_maintenance_to_vehicle btn-info" >اضافة صيانة للمركبة</button>
               </p> --}}
               
               @foreach ( $dailyEmployeesReportTasks as $dailyTasksVal )

               @if(@isset($dailyEmployeesReportTasks) and !@empty($dailyEmployeesReportTasks) and $dailyTasksVal['daily_employees_report_id'] ==  $info->id )
            <table>
               <thead style="color:brown">
                  <th>     Deposit Name </th>
                  <th>     Deposit Size  </th>
                  <th>     Deposit Amount   </th>
               </thead>
               <tbody>
         
                  {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                  <tr>
                     <td style="background-color: brown;color:white">{{ $dailyTasksVal->name }}</td>

                     {{-- <td 
                     @if ($dailyTasksVal->report_status==1) class="text-success" @else class="text-danger"  @endif >
                     @if ($dailyTasksVal->report_status==1) Returned Deposit 
                     @elseif ($dailyTasksVal->report_status==0) Returned Deposit 
                     @endif --}}

                     
                     <td>{{ $dailyTasksVal->size }}</td>
                     <td>{{ $dailyTasksVal->amount }}</td>
                     
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


    
   </tbody>
</table>
@endforeach


         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد تقارير لهذا اليوم</p>
         @endif