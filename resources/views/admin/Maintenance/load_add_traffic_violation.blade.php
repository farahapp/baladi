@if(@isset($Vechile_Information) and !@empty($Vechile_Information) )
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

<form action="{{ route('Maintenance.add_traffic_violation',$Vechile_Information['id']) }}" method="post">
@csrf
<div class="row">
<div class="col-md-4">
   <div class="form-group">
      <label>       violation Name  </label>
      <input  type="text" name="traffic_violation_name" id="traffic_violation_name" class="form-control" value="{{ old('traffic_violation_name') }}" placeholder="violation Name"  >
      @error('traffic_violation_name')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>

<div class="col-md-4">
   <div class="form-group">
      <label>     Violation Amount</label>
      <input  type="text" name="traffic_violation_amount" id="traffic_violation_amount" class="form-control" value="{{ old('traffic_violation_amount') }}" placeholder="Violation Amount"  >
      @error('traffic_violation_amount')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>



<div class="col-md-4">
   <div class="form-group">
      <label>       Violation Date  </label>
      <input  type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" placeholder="Violation Date"  >
      @error('date')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div>


{{-- <div class="col-md-4">
   <div class="form-group">
      <label>      حالة المخالفة  </label>
      <input  type="text" name="traffic_violation_payment_status" id="traffic_violation_payment_status" class="form-control" value="{{ old('traffic_violation_payment_status') }}" placeholder="حالة المخالفة"  >
      @error('traffic_violation_payment_status')
      <span class="text-danger">{{ $message }}</span> 
      @enderror
   </div>
</div> --}}


<div class="col-md-3">
   <div class="form-group">
      <label>       Payment Status  </label>
      <select  name="traffic_violation_payment_status" id="traffic_violation_payment_status" class="form-control">
      <option  value="0">Unpaid</option>
      <option  value="1">Paid</option>
      </select>
   </div>
</div>



   <div class="col-md-12">
      <div class="form-group text-center">
         <button class="btn btn-sm btn-success" type="submit" name="submit">Add Traffic Violation</button>
      </div>
   </div>

</div>
</form>

@else
<p class="bg-danger text-center"> Sorry, there is no data to display.</p>
@section("script")
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements


</script>
@endsection
@endif
