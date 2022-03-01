<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'gender' => ['required'],
            'status' => ['required'],
            'payment' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'phone.required' => ':attribute không được để trống',
            'phone.regex' => ':attribute không đúng định dạng',
            'address.required' => ':attribute không được để trống',
            'address.string' => ':attribute không đúng địng dạng',
            'gender.required' => ':attribute không được để trống',
            'status.required' => ':attribute không được để trống',
            'payment.required' => ':attribute không được để trống',
        ];
    }
    public function attributes()
    {
        return [
            'status' => 'Trạng thái',
            'payment' => 'Phương thức thanh toán',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'gender' => 'Giới tính'
        ];
    }
}
