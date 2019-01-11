<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreCustomer extends FormRequest
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
            'f_name' => 'required|max:191|min:3',
            'l_name' => 'required|max:191|min:3',
            'nickname' => 'required|max:191|min:3',
            'phone' => 'required|max:15|min:8',
            'location' => 'required|max:191|min:5',
        ];
    }

    public function messages()
    {
        return [
            'f_name.required' => 'يجب ادخال الاسم الاول',
            'l_name.required'  => 'يجب ادخال الاسم الاخير',
            'nickname.required'  => 'يجب ادخال اسم الشهرة',
            'phone.required'  => 'يجب ادخال رقم الموبيل',
            'location.required'  => 'يجب ادخال العنوان',
        ];
    }
}
