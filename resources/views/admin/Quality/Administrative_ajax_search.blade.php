@if(@isset($data) and !@empty($data) and count($data)>0 )
    
    
<table id="example2" class="table table-bordered table-hover">
   <thead class="custom_thead">
      <th>   الإسم </th>
      <th>   إسم البصمة </th>
      <th>     اليوم    </th>
      <th>     التاريخ    </th>
      <th>      الزمن  </th>
      <th>    حالة البصمة    </th>
      {{-- <th></th> --}}
   </thead>
   <tbody>
      @foreach ( $data as $info )
      <tr>
         @if(@isset($info->Admin) and !@empty($info->Admin) )
         <td style="background-color: CornflowerBlue;color:white">{{ $info->Admin->name }}</td>
         @else
         <td style="background-color: CornflowerBlue;color:white">لايوجد</td>
         @endif
         <td>{{ $info->sName }}</td>
         <td>{{ \Carbon\Carbon::parse($info->Date)->format('l')}}</td>
         <td>{{ $info->Date }}</td>

         <td> 
            @php
            $time=date("h:i",strtotime($info->Time));
            $newDateTime=date("A",strtotime($info->Time));
            $newDateTimeType= (($newDateTime=='AM')?'صباحا ':'مساء'); 
            @endphp
            {{ $time }}
            {{ $newDateTimeType }}   
         </td>


         {{-- <td>{{ $info->Time }}</td> --}}

         <td 
         @if ($info->AttendanceStatus=="checkIn") class="text-success" @else class="text-danger"  @endif > @if ($info->AttendanceStatus=="checkIn")  دخول @else  خروج  
         @endif
         </td>

         {{-- <td>{{ $info->AttendanceStatus }}</td> --}}


       




   

         {{-- <td @if ($info->vechile_status==1) class="bg-success" @else class="bg-danger"  @endif > @if ($info->vechile_status==1) تعمل @elseif ($info->vechile_status==0) متعطلة @else داخل الصيانة @endif</td> --}}
         
         {{-- <td>
            <a  href="{{ route('Maintenance.edit',$info->id) }}" class="btn btn-primary btn-sm">تعديل</a>
         </td> --}}
         
      </tr>
      {{-- //////////////////////////////////////////////////////////// --}}

      {{-- ///////////////////////////////////////////////////////////////// --}}

    
      @endforeach
   </tbody>
</table>
<br>
         

<div class="col-md-12 text-center" id="attendence_ajax_pagination_in_search">
   {{ $data->links('pagination::bootstrap-5') }}
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@endif