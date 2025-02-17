<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title> بحث أداء طلبات الشهري </title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap_rtl-v4.2.1/bootstrap.min.css')}}">
   <style>
      @media print {
         .hidden-print {
            display: none;
         }
      }

      @media print {
         #printButton {
            display: none;
         }
      }

      td {
         font-size: 15px !important;
         text-align: center;
      }
      th{
         text-align: center;
      }
   </style>

<body style="padding-top: 10px;font-family: tahoma;">


   <table style="width: 60%;float: right;  margin-right: 5px;" dir="rtl">
    
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;"> <span style=" display: inline-block;
               width: 500px;
               height: 30px;
               text-align: center;
               color: red;
               border: 1px solid black;border-radius: 10px !important ">
               بحث أداء طلبات الشهري 
            </span>
         </td>
      </tr>
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style=" display: inline-block;
                  width: 400px;
                  height: 30px;
                  text-align: center;
                  color: blue;
                  border: 1px solid black;border-radius: 10px !important ">
               طبع بتاريخ @php echo date('Y-m-d'); @endphp
            </span>
         </td>
      </tr>
      <tr>
         <td style="text-align: center;padding: 5px;font-weight: bold;">
            <span style=" display: inline-block;
                  width: 400px;
                  height: 30px;
                  text-align: center;
                  color: blue;
                  border: 1px solid black;border-radius: 10px !important ">
               طبع بواسطة {{ auth()->user()->name }}
            </span>
         </td>
      </tr>
   </table>
   <table style="width: 35%;float: right; margin-left: 5px; " dir="rtl">
      <tr>
         <td style="text-align:left !important;padding: 5px;">
            <img style="width: 150px; height: 110px; border-radius: 10px;"
               src="{{ asset('assets/admin/uploads').'/'.$systemData['image'] }}">
            <p>{{ $systemData['company_name'] }}</p>
         </td>
      </tr>
   </table>

   <br>

   @if (@isset($data) && !@empty($data) )
   <table dir="rtl" id="example2" class="table table-bordered table-hover" style="width: 99%;margin: 0 auto;">
      <thead  style="background-color: yellow">
        
            <th style="width: 5%;">الرقم</th>
            <th style="width: 10%;">العام</th>
            <th style="width: 10%;">الشهر</th>
            <th style="width: 25%;">الإسم</th>
            <th style="width: 15%;"> رقم <br> طلبات </th>
            <th style="width: 5%;"> التقيم</th>
            <th style="width: 5%;" >ايام <br> العمل </th>
            <th style="width: 5%;" >ساعات <br> العمل </th>
            <th style="width: 5%;"> عدد <br> الطلبات </th>
            <th style="width: 5%;"> تسجيل <br> متاخر  </th>
            <th style="width: 5%;">  غياب <br> شفتات <br> بعذر </th>
            <th style="width: 5%;"> غياب <br> شفتات <br> بدون عذر </th>
            <th style="width: 5%;"> ايام <br> الغياب  </th>
            <th style="width: 5%;"> ايام <br> الإجازة </th>
            <th style="width: 5%;"> السبب </th>

            

     
         </thead>


      </thead>
      <tbody>
         @php $i=1; @endphp
         @foreach ( $data as $info )
         <tr>
            <td>{{ $i }}</td>
            <td style="background-color: #a8c66c;color:black">{{ $info->year}}</td>
                  <td style="background-color: #1b6535;color:black"> 
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
                  <td style="background-color: Brown;color:black">{{ $info->Employee->driver_name }}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->Employee->operating_talabat_no}}</td>
                  @else
                  <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
                  @endif

                  <td style="background-color: #1b6535;color:black">{{ $info->last_batch_number}}</td>
                  <td style="background-color: #e1dd72;color:black">{{ $info->working_days}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->actual_working_hours}}</td>
                  <td style="background-color: #1b6535;color:black">{{ $info->total_orders}}</td>
                  <td style="background-color: #e1dd72;color:black">{{ $info->late_login_shifts}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->no_show_shifts}}</td>
                  <td style="background-color: #1b6535;color:black">{{ $info->no_show_execused_shifts}}</td>
                  <td style="background-color: #e1dd72;color:black">{{ $info->no_days_lost}}</td>
                  <td style="background-color: #a8c66c;color:black">{{ $info->n_day_off}}</td>
                  <td   style="background-color: #1b6535;color:black">{{ $info->reason}}</td>
         </tr>
         @php $i++; @endphp
         @endforeach
      </tbody>
   </table>
   <br>

   @else
 <div class="clearfix"></div>
      <p class="" style="text-align: center; font-size: 16px;font-weight: bold; color: brown">
      عفوا لاتوجد بيانات لعرضها !!
      </p>

   @endif


   <br>
   <p style="
         padding: 10px 10px 0px 10px;
         bottom: 0;
         width: 100%;
         /* Height of the footer*/ 
         text-align: center;font-size: 16px; font-weight: bold;
         "> {{ $systemData['address'] }} - {{ $systemData['phones'] }} </p>
   <div class="clearfix"></div> <br>
   <p class="text-center">
      <button onclick="window.print()" class="btn btn-success btn-sm" id="printButton">طباعة</button>
   </p>
</body>

</html>