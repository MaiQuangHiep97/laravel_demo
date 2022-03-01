<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePassRequest extends FormRequest
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
            'password' => ['required', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', 'confirmed'],
        ];
    }
    public function messages()
    {
        return [
            'password.required' => ':attribute không được để trống',
            'password.regex' => ':attribute phải có ít nhất 8 ký tự và chữ đàu in hoa',
            'password.confirmed' => ':attribute và xác nhận mật khẩu phải giống nhau'
        ];
    }
    public function attributes()
    {
        return [
            'password' => 'Mật khẩu'
        ];
    }
}
