@if(@isset($data) and !@empty($data) and count($data)>0 )
<div class="row tbl-fixed">
   <table id="example2" class="table-striped table-condensed">
      <thead class="custom_thead" style="background-color: Maroon;color:white">
         <th>   الرقم </th>
         <th>   التاريخ </th>
         <th>   الإسم </th>
         <th class="verticalTableHeader">   رقم <br> طلبات </th>
         <th class="verticalTableHeader">   التقيم </th>
         <th class="verticalTableHeader">   ساعات <br> العمل </th>
         <th class="verticalTableHeader">   عدد <br> الطلبات </th>
         <th class="verticalTableHeader">   الطلبات <br> الضائعة  </th>
         <th class="verticalTableHeader">   الساعات <br> الضائعة  </th>
         <th class="verticalTableHeader">   وصول <br> متاخر  </th>
         <th class="verticalTableHeader">    غياب <br> بدون عذر </th>
         <th class="verticalTableHeader">    غياب <br>بعذر </th>
         <th class="verticalTableHeader">    نسبة <br>الطلبات </th>
         <th class="verticalTableHeader">   ملاحظات </th>

        
         {{-- <th></th> --}}
      </thead>
      <tbody>
         @foreach ( $data as $info )
         <tr>
            <td>{{ (($data->firstItem() + $loop->index))  }}</td>
            <td style="background-color: #1b6535;color:black">{{ $info->date}}</td>
            @if(@isset($info->Employee) and !@empty($info->Employee) )
            <td style="background-color: Brown;color:white">{{ $info->Employee->driver_name }}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->Employee->operating_talabat_no}}</td>
            @else
            <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
            @endif

            <td style="background-color: #1b6535;color:white">{{ $info->last_batch}}</td>
            <td style="background-color: #e1dd72;color:black">{{ $info->actual_working}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->orders}}</td>
            <td style="background-color: #1b6535;color:white">{{ $info->loss_orders}}</td>
            <td style="background-color: #e1dd72;color:black">{{ $info->loss_hours}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->late_login}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->no_show}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->no_show_execused}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->oerders}}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->noets}}</td>

           
           

          




      

         
            
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
