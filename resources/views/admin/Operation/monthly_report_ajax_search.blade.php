
@if(@isset($data) and !@empty($data) and count($data)>0 )
<div class="row tbl-fixed">
   <table id="example2" class="table-striped table-condensed">
      <thead class="custom_thead" style="background-color: Maroon;color:white">
         <th>   الرقم </th>
         <th>   العام </th>
         <th>   الشهر </th>
         <th>   الإسم </th>
         <th class="verticalTableHeader">   رقم <br> طلبات </th>
         <th class="verticalTableHeader">   التقيم </th>
         <th class="verticalTableHeader">   ايام <br> العمل </th>
         <th class="verticalTableHeader">    ساعات <br> العمل </th>
         <th class="verticalTableHeader">   عدد <br> الطلبات </th>
         <th class="verticalTableHeader">   تسجيل <br> متاخر </th>
         <th class="verticalTableHeader">   غياب <br> شفتات <br> بعذر </th>
         <th class="verticalTableHeader">   غياب <br> شفتات <br> بدون عذر </th>
         <th class="verticalTableHeader">   ايام <br> الغياب  </th>
         <th class="verticalTableHeader">    ايام <br> الإجازة </th>
         <th  class="verticalTableHeader">    السبب </th>
        
         {{-- <th></th> --}}
      </thead>
      <tbody>
         @foreach ( $data as $info )
         <tr>
            <td>{{ (($data->firstItem() + $loop->index))  }}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->year}}</td>
            <td style="background-color: #1b6535;color:white"> 
               @if ($info->month=='01') يناير   
               @elseif ($info->month=='02') فبراير  
               @elseif ($info->month=='03') مارس  
               @elseif ($info->month=='04') أبريل  
               @elseif ($info->month=='05') مايو  
               @elseif ($info->month=='06') يونيو  
               @elseif ($info->month=='07') يوليو  
               @elseif ($info->month=='08') أغسطس  
               @elseif ($info->month=='09') سبتمبر  
               @elseif ($info->month=='10') أكتوبر  
               @elseif ($info->month=='11') نوفمبر  
               @elseif ($info->month=='12') ديسمبر                 
               @endif
            </td>

           


            @if(@isset($info->Employee) and !@empty($info->Employee) )
            <td style="background-color: Brown;color:white">{{ $info->Employee->driver_name }}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->Employee->operating_talabat_no}}</td>
            @else
            <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
            @endif

            <td style="background-color: #1b6535;color:white">{{ $info->last_batch_number}}</td>
            <td style="background-color: #e1dd72;color:black">{{ $info->working_days}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->actual_working_hours}}</td>
            <td style="background-color: #1b6535;color:white">{{ $info->total_orders}}</td>
            <td style="background-color: #e1dd72;color:black">{{ $info->late_login_shifts}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->no_show_shifts}}</td>
            <td style="background-color: #1b6535;color:black">{{ $info->no_show_execused_shifts}}</td>
            <td style="background-color: #e1dd72;color:black">{{ $info->no_days_lost}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->n_day_off}}</td>
            <td   style="background-color: #1b6535;color:black">{{ $info->reason}}</td>

           
           

          




      

         
            
         </tr>
         {{-- //////////////////////////////////////////////////////////// --}}

         {{-- ///////////////////////////////////////////////////////////////// --}}

       
         @endforeach
      </tbody>
   </table>
   </div>
   <br>

<div class="col-md-12 text-center" id="ajax_pagination_in_search">
{{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif
