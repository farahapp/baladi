@if(@isset($Vehicle_Maintenance) and !@empty($Vehicle_Maintenance) )
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

<form action="{{ route('Maintenance.add_vechile_spare_part',$Vehicle_Maintenance['id']) }}" method="post">
@csrf
<div class="row">
<div class="col-md-4">
   <div class="form-group">
      <label>      Spare Part Name  </label>
      <input  type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="اسم قطعة الغيار "  >
      @error('name')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4">
   <div class="form-group">
      <label>       Spare Part Price  </label>
      <input  type="text" name="price" id="price" class="form-control" value="{{ old('price') }}" placeholder="سعر قطعة الغيار"  >
      @error('price')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>






   <div class="col-md-12">
      <div class="form-group text-center">
         <button class="btn btn-sm btn-success" type="submit" name="submit">Add spare part</button>
      </div>
   </div>

</div>
</form>

@else
<p class="bg-danger text-center"> Sorry, there is no data to display.</p>
@section("script")
<script  src="{{ asset('/../assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements


</script>
@endsection
@endif
