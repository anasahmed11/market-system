<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreExpense extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'received_amount' => 'required',
            'paid_amount' => 'required',
            'payment_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب اختيار الموضف',
            'received_amount.required'  => 'بجب ادخال المبلغ المستلم ',
            'paid_amount.required'  => 'يجب ادخال المبلغ المدفوع',
            'payment_date.required'  => 'يجب ادخال تاريخ الدفع'
        ];
    }

}
