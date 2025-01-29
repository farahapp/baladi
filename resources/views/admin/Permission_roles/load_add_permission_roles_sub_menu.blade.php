@if(@isset($permission_roles_main_menus) and !@empty($permission_roles_main_menus) )
@section("css")
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" src="{{ asset('/../assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
<form action="{{ route('permission_roles.add_permission_roles_sub_menu',$permission_roles_main_menus['id']) }}" method="post">
@csrf
   <div class="col-md-12">
      <div class="form-group">
          <label>   بيانات القوائم الفرعية  </label>
            <select name="permission_sub_menues_id[]" multiple id="permission_sub_menues_id" class="form-control select2 ">
               <option  value=""></option>
               @if (@isset($permission_sub_menues) && !@empty($permission_sub_menues))
               @foreach ($permission_sub_menues as $info )
               <option value="{{ $info->id }}"> {{ $info->name }} </option>
               @endforeach
               @endif
            </select>
      </div>
   </div>



   <div class="col-md-12">
      <div class="form-group text-center">
         <button class="btn btn-sm btn-success" type="submit" name="submit">اضف القائمة الفرعية </button>
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
