@if(@isset($data) and !@empty($data))

<div class="form-group">
   <label>     اسم الصلاحية </label>
   <input  type="text" name="name_edit" id="name_edit" class="form-control" value="{{ $data['name'] }}" >
</div>
<div class="form-group" style="text-align: center;padding-top: 10px">
   <button class="btn btn-sm btn-primary" type="submit" data-id="{{ $data['id'] }}" id="do_edit_sub_permission_btn">حفظ التعديل  </button>
</div>
@else
<p class="bg-danger text-center"> عفوا لاتوجد بيانات لعرضها</p>



@endif