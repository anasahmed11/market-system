<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'employee_id' => 'required',
            'is_admin' => 'required',
             'email'      => 'required|email|unique:users',
             'phone'      => 'required|unique:users',
             'password'   => 'required|max:191|min:3',
            'cpassword'   => 'required||same:password',

        ];

    }

    public function messages()
    {
        return [
            'employee_id.required' => 'يجب اختيار الموضف',
            'is_admin.required' => 'يجب اختيار الصلاحيه',
            'email.unique' => 'هذا البريد الالكترونى مستخدم ',
            'password.required'  => 'بجب ادخال كلمة المرور ',
            'phone.unique' => 'هذا الموبيل مستخدم من قبل ',
            'phone.required'  => 'بجب ادخال رقم الموبيل ',
            'cpassword.required'  => 'يجب تأكيد كلمة المرور',

        ];
    }
}
