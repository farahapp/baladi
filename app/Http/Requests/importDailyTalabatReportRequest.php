<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class importDailyTalabatReportRequest extends FormRequest
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
         'upload_date'=>'required',
         'import_file'=>'required|mimes:csv,xlsx,xls'
        //  'import_file'=>'required|in:csv,xlsx,xls'
        ];
    }
    public function messages()
    {
    return [
     'upload_date.required'=>'تاريخ تحديث الملف  مطلوب',
     'import_file.required'=>'ملف اداء طلبات اليومي مطلوب'  
    ];    
    }
}
