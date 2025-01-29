<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HumanResourceResourcest extends FormRequest
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
            'driver_name'=>'required',
            'appointment_type'=>'required',
            'contract_type'=>'required',
            'isSigningInitialContract'=>'required',
            'initial_contract_image'=>'required_if:isSigningInitialContract,1',
            'isVisaPrinted'=>'required',
            'visa_number'=>'required_if:isVisaPrinted,1',
            'visa_start_date'=>'required_if:isVisaPrinted,1',
            'visa_end_date'=>'required_if:isVisaPrinted,1',
            'visa_image'=>'required_if:isVisaPrinted,1',
            'driver_gender'=>'required',
            'brith_date'=>'required',
            'marital_status'=>'required',
            'sons_number'=>'required_if:marital_status,1',
            'driver_pasport_no'=>'required',
            'driver_pasport_exp'=>'required',
            'driver_pasport_image'=>'required',
            'Qualifications_id'=>'required',
            'driver_sudan_tel'=>'required',
            'sudan_driver_Basic_stay_address'=>'required',
            'isPostPayInSudan'=>'required',
            'post_pay_amount'=>'required_if:isPostPayInSudan,1',
            'post_pay_pill_image'=>'required_if:isPostPayInSudan,1',
            'does_has_sudanese_Driving_License'=>'required',
            'sudanese_driving_License_number'=>'required_if:does_has_sudanese_Driving_License,1',
            'sudanese_driving_license_types_id'=>'required_if:does_has_sudanese_Driving_License,1',
            'sudanese_driving_license_Image'=>'required_if:does_has_sudanese_Driving_License,1',
            'driver_photo'=>'required',
            'arrive_qater_date'=>'required',
            'isGivePassPort'=>'required',
            'give_passport_image'=>'required_if:isGivePassPort,1',
            'isSigningFullFinancialDebt'=>'required',
            'SigningFullFinancialDebt_Image'=>'required_if:isSigningFullFinancialDebt,1',
            'isSigningPenaltyClause'=>'required',
            'isSigningPenaltyClause_Image'=>'required_if:isSigningPenaltyClause,1',
            'uniform_status'=>'required',
            'driver_quater_tel'=>'required',
            'driver_email'=>'required',
            'Functional_status'=>'required',
            'does_has_ateendance'=>'required',
            'driver_residency_process_status'=>'required',
            'driver_residency_permit_id'=>'required_if:driver_residency_process_status,1',
            'driver_end_residencyIDate'=>'required',
            'driver_residency_id_Image'=>'required',
            'driver_bank_process'=>'required',
            'driver_bank_number'=>'required_if:driver_bank_process,1',
            'driving_school_status'=>'required',
            'driving_permit_number'=>'required_if:driving_school_status,1',
            'driving_permit_image'=>'required_if:driving_school_status,1',
            'ismedicalinsurance'=>'required',
            'medicalinsuranceNumber'=>'required_if:ismedicalinsurance,1',
            'qater_staies_address'=>'required',
            'driver_notes'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'driver_name.required'=>'اسم السائق مطلوب',
            'appointment_type.required'=>' نوع التقديم مطلوب',
            'contract_type.required'=>'نوع العقد  مطلوب',
            'isSigningInitialContract.required'=>' توقيع العقد المبدئي  مطلوب',
            'initial_contract_image.required_if'=>'  صورة توقيع العقد المبدئي  مطلوب',
            'isVisaPrinted.required'=>'اصدار التاشيرة  مطلوب',
            'visa_number.required_if'=>'  رقم   التاشيرة  مطلوب',
            'visa_start_date.required_if'=>'  تاريخ اصدار   التاشيرة  مطلوب',
            'visa_end_date.required_if'=>'  تاريخ انتهاء التاشيرة  مطلوب',
            'visa_image.required_if'=>'  صورة التاشيرة  مطلوب',
            'driver_gender.required'=>' نوع الجنس مطلوب',
            'brith_date.required'=>' تاريخ الميلاد مطلوب',
            'marital_status.required'=>' الحالة الاجتماعية مطلوب',
            'sons_number.required_if'=>'   عدد الابناء مطلوب',
            'driver_pasport_no.required'=>' رقم جواز السفر مطلوب',
            'driver_pasport_exp.required'=>' تاريخ انتهاء مطلوب',
            'driver_pasport_image.required'=>'صورة جواز السفر مطلوب',
            'Qualifications_id.required'=>' المؤهل الدراسي مطلوب',
            'driver_sudan_tel.required'=>'رقم الهاتف في البلد الام  مطلوب',
            'sudan_driver_Basic_stay_address.required'=>'  عنوان اقامة السائق في البلد الام  مطلوب',
            'isPostPayInSudan.required'=>'هل قام بتوريد مبلغ في البلد الام  مطلوب',
            'post_pay_amount.required_if'=>'   قيمة المبلغ المورد في البلد الام مطلوب',
            'post_pay_pill_image.required_if'=>'       صورة ايصال بنكك مطلوب',
            'does_has_sudanese_Driving_License.required'=>'هل يمتلك رخصة قيادة سودانية  مطلوب',
            'sudanese_driving_License_number.required_if'=>' رقم رخصة القيادة في البلد الام   مطلوب',
            'sudanese_driving_license_types_id.required_if'=>'   نوع رخصة القيادة في البلد الام مطلوب',
            'sudanese_driving_license_Image.required_if'=>'   صورة الرخصة في البلد الام مطلوب',
            'driver_photo.required'=>' صورة السائق مطلوب',
            'arrive_qater_date.required'=>'تاريخ دخول  مطلوب',
            'isGivePassPort.required'=>' استلام الجواز مطلوب',
            'give_passport_image.required_if'=>'صورة توقيع اقرار تسليم الجواز مطلوب',
            'isSigningFullFinancialDebt.required'=>'توقيع المديونية مطلوب',
            'SigningFullFinancialDebt_Image.required_if'=>'   صورة توقيع المديونية مطلوب',
            'isSigningPenaltyClause.required'=>'توقيع الشرط الجزائي  مطلوب',
            'isSigningPenaltyClause_Image.required_if'=>'   صورة توقيع الشرط الجزائي مطلوب',
            'uniform_status.required'=>'حالة الزي الرسمي  مطلوب',
            'driver_quater_tel.required'=>'رقم الهاتف القطري  مطلوب',
            'driver_email.required'=>'البريد الاكتروني مطلوب',
            'Functional_status.required'=>' الحالة الوظيفية مطلوب',
            'does_has_ateendance.required'=>' هل له بصمة حضور وانصراف مطلوب',
            'driver_residency_process_status.required'=>' اجراءات اصدار الاقامة مطلوب',
            'driver_residency_permit_id.required_if'=>'رقم بطاقة الاقامة مطلوب',
            'driver_end_residencyIDate.required'=>' تاريخ انتهاء بطاقة الاقامة مطلوب',
            'driver_residency_id_Image.required'=>' صورة بطاقة الاقامة مطلوب',
            'driver_bank_process.required'=>' اجراءات البنك واصدار دفتر الشيكات مطلوب',
            'driver_bank_number.required_if'=>'  رقم الحساب البنكي مطلوب',
            'driving_school_status.required'=>' اختر حالة المدرسة مطلوب',
            'driving_permit_number.required_if'=>'  رقم رخصة القيادة القطرية مطلوب',
            'driving_permit_image.required_if'=>'  صورة رخصة  القيادة مطلوب',
            'ismedicalinsurance.required'=>' هل له تأمين طبي مطلوب',
            'medicalinsuranceNumber.required_if'=>'     رقم التامين الطبي للسائق مطلوب',
            'qater_staies_address.required'=>' عنوان الاقامة داخل قطر مطلوب',
            'driver_notes.required'=>' ملاحظات على الموظف مطلوب',
        ];
    }
}
