<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintsRequest extends FormRequest
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
         'complaint_title'=>'required',
         'complaint'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'complaint_title.required'=>'اسم الشكوي مطلوب',
            'complaint.required'=>'تفاصيل الشكوى مطلوب'
           ];  
    }
}
