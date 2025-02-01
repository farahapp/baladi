@if(@isset($permission_roles_sub_menu) and !@empty($permission_roles_sub_menu) )
@section("css")
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ secure_asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
<form action="{{ route('permission_roles.add_permission_roles_sub_menues_action',$permission_roles_sub_menu['id']) }}" method="post">
@csrf
   <div class="col-md-12">
      <div class="form-group">
          <label>  بيانات الصلاحيات المباشرة ل({{$permission_roles_sub_menu->permission_sub_menues->name}})   </label>
            <select name="permission_sub_menues_actions_id[]" multiple id="permission_sub_menues_actions_id" class="form-control select2 ">
               <option  value=""></option>
               @if (@isset($permission_sub_menues_actions) && !@empty($permission_sub_menues_actions))
               @foreach ($permission_sub_menues_actions as $info )
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
<script  src="{{ secure_asset('assets/admin/plugins/select2/js/select2.full.min.js') }}"> </script>
<script>
   //Initialize Select2 Elements


</script>
@endsection
@endif
