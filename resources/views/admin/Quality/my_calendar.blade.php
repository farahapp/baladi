@extends('layouts.admin')
@section('title')
الصيانة
@endsection
@section('contentheader')
جدول المحاضرات  
@endsection
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheaderactivelink')
<a href="{{ route('Maintenance.index') }}">   جدول المحاضرات   </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">   جدول المحاضرات       
         <a href="{{ route('ShiftsTypes.index') }}" class="btn btn-sm btn-info">إضافة محاضرات</a>
        </h3>
         <input type="hidden" id="ajax_do_importAttendenceStore" value="{{route('Quality.importAttendenceStore')}}">
         <input type="hidden" id="token_search" value="{{csrf_token()}}">
      </div>
      <div class="card-body">
        

      </div class="row">


        <div class="col-md-12">
            <div id="calendar"></div>
        </div>


      </div>





      </div>
   </div>
</div>
@endsection

@section("script")



<script  src="{{ asset('/../assets/admin/plugins/fullcal/dist/index.global.min.js') }}"  defer> </script>

{{-- <script type="text/javascript">

var calendarID = document.getElementById('calendar');
var calendar= new FullCalendar.Calendar(calendarID,{
            headerToolbar: {
                left:'prev,next,today',
                center: 'title',
                right: 'dayGridMonth, timeGridWeek, timeGridDay, listMonth'
            },
});
 calendar.render();



</script> --}}

<script>

    //  'ltr' (default) or 'rtl'
    //   Boolean, default: false


    var events =new Array();

    @foreach ($data as $value)
    @foreach ($value['week'] as $week)     
    events.push({
            title: '{{ $value['name'] }}',
            daysOfWeek: [{{ $week['fullcalendar_day'] }}],
            startTime: '{{ $week['start_time'] }}',
            endTime: '{{ $week['end_time'] }}',
    });
    @endforeach
    @endforeach



    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');




      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
                left:'next,today,prev',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            initialDate: '<?=date('Y-m-d')?>',
            navLinks: true,
            editable: false,
            events: events,
            initialView: 'timeGridWeek',
      });
      calendar.render();
    });

  </script>
@endsection
