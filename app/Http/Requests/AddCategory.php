<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class AddCategory extends FormRequest
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
            'name' => ['required', 'string'],
            'cate_slug' => ['required', 'string',  function ($attribute, $value, $fail) {
                $cate = Category::where('slug', $value)->first();
                if ($cate) {
                    $fail('Slug đã tồn tại');
                }
            }]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống',
            'name.string' => ':attribute không đúng định dạng',
            'cate_slug.required' => ':attribute không được để trống',
            'cate_slug.string' => ':attribute không đúng định dạng',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'cate_slug' => 'Slug'
        ];
    }
}
