@if(@isset($data) and !@empty($data) and count($data)>0 )
    
@foreach ( $data as $info )

<main class="table">
   <section class="table__body">
<table id="example2">
   <thead >
      <tr>
      <th>     Name </th>
      <th>      Date </th>
      <th>    Employee Notes   </th>
      <th>    Report Status    </th>
     
      <th></th>
   </tr>
   </thead>
   <tbody>
      <tr>
         <td style="background-color: CornflowerBlue;color:white">{{ $info->added->name }}</td>
         {{-- <td>{{ $info->vechile_type }}</td> --}}
         <td>{{ $info->date }}</td>

         <td>{{ $info->note }}</td>

         <td> 
            <select    name="report_status" id="report_status" report_id_value="{{ $info->id }}" class="form-control">
            <option  @if(old('report_status',$info->report_status)==0) selected  @endif  value="0">Not reviewed</option>
            <option @if(old('report_status',$info->report_status)==1) selected @endif  value="1">reviewed</option>
            </select>
         </td> 

         <td>
            <a style="color:white" class="btn btn-info btn-sm load_add_note_btn">Quality Department Notes</a>
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
               <thead class="" style="color:purple">
                  <th>     Task </th>
                  <th>      Task Status  </th>
                  <th>    Reasons for not completing the task  </th>
               </thead>
               <tbody>
         
                  {{-- @foreach ( $dataSub_menueAction as $action ) --}}
                  <tr>
                     <td style="background-color: brown;color:white">{{ $dailyTasksVal->name }}</td>

                     <td 
                     @if ($dailyTasksVal->report_status==1) class="text-success" @else class="text-danger"  @endif >
                     @if ($dailyTasksVal->report_status==1) Mission accomplished 
                     @elseif ($dailyTasksVal->report_status==0) unaccomplished Mission  
                     @endif


                     <td>{{ $dailyTasksVal->note }}</td>
                     
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
</section>
</main>
@endforeach


         <br>
         

         <div class="col-md-12 text-center" >
            {{ $data->links('pagination::bootstrap-5') }}
         </div>
         @else
         <p class="bg-danger text-center"> عفوا لاتوجد تقارير لهذا اليوم</p>
         @endif