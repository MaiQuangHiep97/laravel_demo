<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => ':attribute không được để trống',
            'email.email' => ':attribute không đúng định dạng',
            'email.max' => ':attribute có độ dài không quá 255 ký tự',
            'password.required' => ':attribute không được để trống',
            'password.regex' => ':attribute phải có ít nhất 8 ký tự và chữ đàu in hoa',
        ];
    }
    public function attributes()
    {
        return [
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu'
        ];
    }

}
