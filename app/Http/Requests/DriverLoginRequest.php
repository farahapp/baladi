<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DriverLoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
         'driver_email'=>'required',
         'driver_password'=>'required'
        ];

    }
    public function messages()
    {
    return [
     'driver_email.required'=>' البريد الإلكتروني مطلوب',
     'driver_password.required'=>'كلمة المرور مطلوبة'   
    ];    
    }
}
