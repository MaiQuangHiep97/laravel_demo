<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string'],
            'phone' => ['required','regex:/^[0-9]*$/'],
            'address' => ['required', 'string'],
            'gender' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => ':attribute không được để trống',
            'email.email' => ':attribute không đúng định dạng',
            'email.max' => ':attribute có độ dài không quá 255 ký tự',
            'name.required' => ':attribute không được để trống',
            'name.string' => ':attribute không được để trống',
            'phone.required' => ':attribute không được để trống',
            'phone.regex' => ':attribute không đúng định dạng',
            'address.required' => ':attribute không được để trống',
            'address.string' => ':attribute không đúng địng dạng',
            'gender.required' => ':attribute không được để trống',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'name' => 'Họ và tên',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'gender' => 'Giới tính'
        ];
    }
}
