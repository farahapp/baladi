<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class importMonthlyTalabatReportRequest extends FormRequest
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
            'registeration_date'=>'required',
            'months'=>'required',
            'import_file'=>'required|mimes:csv,xlsx,xls'
        //  'import_file'=>'required|in:csv,xlsx,xls'
        ];
    }
    public function messages()
    {
    return [
        'registeration_date.required'=>'سنة التحديث للملف  مطلوب',
        'months.required'=>'شهر تحديث الملف  مطلوب',
        'import_file.required'=>'ملف اداء طلبات الشهري مطلوب'  
    ];    
    }
}
