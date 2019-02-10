<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddDebtSupplier extends FormRequest
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
            'debt_type' => 'required|numeric',
            'value' => 'required|numeric',
            'description' => 'required|max:500|min:3',
            'date' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'debt_type' => 'يجب تحديد النوع',
            'value' => 'ادخل القيمة',
            'description' => 'ادخل الوصف',
            'date' => 'ادخل التاريخ'
        ];
    }
}
