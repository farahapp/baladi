<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
         'name'=>'required',
         'permission_roles_id'=>'required',
         'email'=>'required',
         'username'=>'required',
         'password'=>'required',
         'active'=>'required'
        ];
    }
    public function messages()
    {
        return [
      'name.required'=>'اسم المستخدم كاملا مطلوب',
       'permission_roles_id.required'=>'دور صلاحيات مطلوب',
       'email.required'=>'البريد الاكتروني مطلوب',
       'username.required'=>'اسم المستخدم لتسجيل الدخول مطلوب',
       'password.required'=>'كلمة المرور لتسجيل الدخول مطلوب',
       'active.required'=>'حالة تفعيل الفرع مطلوب',

        ];
    }
}
