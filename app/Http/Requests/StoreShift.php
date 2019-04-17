<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class StoreShift extends FormRequest
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
            'name' =>'required',
            'from' => 'required',
            'to' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ' يجب ادخال اسم الوردية',
            'from.required' => 'يجب تحديد بداية الورديه ',
            'to.required'  => 'يجب تحديد انتهاء الوردية '
        ];
    }


  
}
