@if(@isset($Vechile_Information) and !@empty($Vechile_Information) )
@section("css")
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

<form action="{{ route('Maintenance.add_maintenance_to_vehicle',$Vechile_Information['id']) }}" method="post">
@csrf
<div class="row">
<div class="col-md-4">
   <div class="form-group">
      <label>      اسم الصيانة  </label>
      <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="اسم الصيانة"  >
      @error('name')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4">
   <div class="form-group">
      <label>       تكلفة الصيانة بدون قطع الغيار  </label>
      <input  type="text" name="net_cost" id="net_cost" class="form-control" value="{{ old('net_cost') }}" placeholder="تكلفة الصيانة بدون قطع الغيار"  >
      @error('net_cost')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4" >
   <div class="form-group">
      <label>    تكلفة الصيانة الكلية   </label>
      <input  type="text" name="total_cost" id="total_cost" class="form-control" value="{{ old('total_cost') }}" placeholder="تكلفة الصيانة الكلية   "  >
      @error('total_cost')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>



<div class="col-md-4">
   <div class="form-group">
      <label>      تاريخ الصيانة  </label>
      <input  type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" placeholder=" تاريخ الصيانة  "  >
      @error('date')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4">
   <div class="form-group">
      <label>      ورشة الصيانة  </label>
      <input  type="text" name="workshop" id="workshop" class="form-control" value="{{ old('workshop') }}" placeholder="ورشة الصيانة"  >
      @error('workshop')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4">
   <div class="form-group">
      <label>       فني الصيانة   </label>
      <input  type="text" name="technician" id="technician" class="form-control" value="{{ old('technician') }}" placeholder="فني الصيانة"  >
      @error('technician')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>



<div class="col-md-12">
   <div class="form-group">
      <label> ملاحظات علي الصيانة </label>
      <textarea type="text" name="maintenance_notes" id="maintenance_notes" class="form-control" >
         {{ old('maintenance_notes') }}

      </textarea>
      @error('maintenance_notes')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>



   <div class="col-md-12">
      <div class="form-group text-center">
         <button class="btn btn-sm btn-success" type="submit" name="submit">إضافة الصيانة  </button>
      </div>
   </div>

</div>
</form>

@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>
@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements


</script>
@endsection
@endif
