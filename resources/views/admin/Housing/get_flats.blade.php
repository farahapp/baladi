<select  name="flats" id="flats" class="form-control select2" driver_id_value="{{$other['old_flats_id']}}">
  @if (@isset($other['flats']) && !@empty($other['flats']))
  <option  value="0">خارج المبنى  </option>
   @foreach ($other['flats'] as $info )
   <option  value="{{ $info->id }}"> {{ $info->flat_No }} </option>
   @endforeach
   @endif
</select>



@section("script")

<script>
   //Initialize Select2 Elements
   $('.select2').select2({
     theme: 'bootstrap4'
   });

  



</script>
@endsection