<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class flatDriverRequest extends FormRequest
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
        'flats'=>'required',
        'bulding'=>'required'  
        ];
    }

    public function messages()
    {
        return [
            'flats.required'=>'رقم الشقة مطلوب',
            'bulding.required'=>'رقم المبنى مطلوب'  
            ];    
    }
}
