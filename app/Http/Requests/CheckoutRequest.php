<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'phone' => ['required','regex:/^[0-9]*$/'],
            'address' => ['required', 'string'],
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => ':attribute không được để trống',
            'phone.regex' => ':attribute không đúng định dạng',
            'address.required' => ':attribute không được để trống',
            'address.string' => ':attribute không đúng định dạng',
        ];
    }
    public function attributes()
    {
        return [
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
        ];
    }
}
