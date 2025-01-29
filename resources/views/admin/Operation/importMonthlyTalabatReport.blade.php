@extends('layouts.admin')
@section('title')
التشغيل
@endsection
@section('contentheader')
تحديث بيانات أداء السائقين الشهري (طلبات)  
@endsection
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/alertify.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/alertifyjs/build/css/themes/bootstrap.min.css') }}">
@endsection

@section('contentheaderactivelink')
<a href="{{ route('Operation.monthlyReport_talabat') }}">   تحديث بيانات أداء السائقين الشهري (طلبات)   </a>
@endsection
@section('contentheaderactive')
اضافة
@endsection
@section('content')
<div class="col-12">
   <div class="card">
      <div class="card-header">
         <h3 class="card-title card_title_center">  اضافة تحديث بيانات أداء السائقين الشهري (طلبات)       
         </h3>
         <input type="hidden" id="ajax_do_importAttendenceStore" value="{{route('Quality.importAttendenceStore')}}">
         <input type="hidden" id="token_search" value="{{csrf_token()}}">
      </div>
      <div class="card-body">
         <form  id="fileUploadForm"  action="{{ route('Operation.importMonthlyTalabatReportStore') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">

          
                <div class="col-md-6">
                    <div class="form-group">
                       <label>      سنة التحديث    </label>
                       <input  type="number" min="1900" max="2099" step="1" value="2024" name="registeration_date" id="registeration_date" class="form-control"  placeholder="سنة التحديث"  >
                       @error('registeration_date')
                       <span class="text-danger">{{ $message }}</span> 
                       @enderror
                    </div>
                 </div>


                <div class="col-md-6">
                    <div class="form-group">
                       <label> إختيار شهر التحديث   </label>
                          <select name="months"  id="months" class="form-control" >
                             {{-- <option  value="" >اختر السائقين </option> --}}
                             {{-- <option  value="all">البحث بالكل </option> --}}
                             <option   value="01">يناير </option>
                             <option   value="02">فبراير </option>
                             <option   value="03">مارس </option>
                             <option   value="04">أبريل </option>
                             <option   value="05">مايو </option>
                             <option   value="06">يونيو </option>
                             <option   value="07">يوليو </option>
                             <option   value="08">أغسطس </option>
                             <option   value="09">سبتمبر </option>
                             <option   value="10">أكتوبر </option>
                             <option   value="11">نوفمبر </option>
                             <option   value="12">ديسمبر </option>
                          </select>
                          @error('months')
                          <span class="text-danger">{{ $message }}</span> 
                          @enderror
                    </div>
                 </div>


                 <div class="col-md-12">
                    <div class="form-group">
                <input type="file" name="import_file" class="form-control" />
                        @error('import_file')
                        <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
                </div>



               
                

           



              


            <div class="col-md-12 mt-3">
               <div class="form-group text-center">
                  <button class="btn btn-sm btn-info" type="submit" name="submit"> تحديث البيانات  </button>
                  {{-- <a href="{{ route('Quality.index') }}" class="btn btn-danger btn-sm">الغاء</a> --}}
               </div>
            </div>

            
            
         </div>

         <div class="form-group">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
            <div class="percent"></div>
        </div>

        
         {{-- <div class="progress mb-3">
            <div class="bar"></div>
            <div class="percent">0%</div>
        </div> --}}

      </form>
      </div>
   </div>
</div>
@endsection

@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"> </script>
<script  src="{{ asset('/../assets/admin/plugins/alertifyjs/build/alertify.min.js') }}"> </script>
<script>
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    });
 </script>

<script>
    // $(document).ready(function(){

    //     var bar=$('.bar');
    //     var percent=$('.percent');
    //     $('form').ajaxForm({
    //         beforeSend:function(){
    //             var percentVal='50%';
    //             bar.width(percentVal);
    //             percent.html(percentVal);
    //         },
    //         uploadProgress:function(event,position,total,percentComplete){
    //             var percentVal=percentComplete+'%';
    //             bar.width(percentVal);
    //             percent.html(percentVal);
    //         },
    //         complete:function(){
    //             // alert('File uploaded successfully');
    //         }

    //     });
    // });




    // $(document).ready(function () {
        
    //     $('#fileUploadForm').on('submit',function(event){
    //            alert('fileUploadForm');
    //         //    event.preventDefault();
              

    //     });






    $(document).ready(function(){
        var percent=$('.percent');
        $('#fileUploadForm').ajaxForm({
            beforeSend: function () {
                var percentage = '0%';
                percent.html( percentage);
            },
            uploadProgress: function (event, position, total, percentComplete) {
                var percentage = percentComplete;
                percent.html( percentage+'%');
                $('.progress .progress-bar').css("width", percentage+'%', function() {
                    return $(this).attr("aria-valuenow", percentage) + "%";
                })
            },
            complete: function (xhr) {
                // percent.html("100%");
                //  alert('File uploaded successfully');
                 alertify.set('notifier','position','top-right');
                 alertify.success("تم تحديث الحضور بنجاح");

            }
             return false;           
        });
    });






// });

</script>
@endsection
