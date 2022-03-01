<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'slug_old' => 'required',
            'product_name' => 'required|string',
            'product_desc' => 'required|string',
            'product_price' => 'required|string|regex:/^\d+(\.\d{1,2})?$/',
            'product_detail' => 'required|string',
            'product_cate' => 'required',
            'product_thumb' => 'required',
            'product_images' => 'required',
            'product_slug' => ['required', 'string', function ($attribute, $value, $fail) {
                $product = Product::where('slug', $value)->exists();
                if(($value != $this->slug_old) && $product){
                    $fail('Slug đã tồn tại');
                }
            }],
        ];
    }
    public function messages()
    {
        return [
            'product_name.required' => ':attribute không được để trống',
            'product_desc.required' => ':attribute không được để trống',
            'product_price.required' => ':attribute không được để trống',
            'product_detail.required' => ':attribute không được để trống',
            'product_cate.required' => ':attribute không được để trống',
            'product_thumb.required' => ':attribute không được để trống',
            'product_images.required' => ':attribute không được để trống',
            'product_name.string' => ':attribute không đúng định dạng',
            'product_desc.string' => ':attribute không đúng định dạng',
            'product_price.string' => ':attribute không đúng định dạng',
            'product_detail.string' => ':attribute không đúng định dạng',
            'product_thumb.image' => ':attribute không đúng định dạng',
            'product_images.image' => ':attribute không đúng định dạng',
            'product_thumb.mimes' => ':attribute chỉ nhận đuôi: jpeg, png, jpg, gif, svg',
            'product_images.mimes' => ':attribute chỉ nhận đuôi: jpeg, png, jpg, gif, svg',
            'product_thumb.max' => ':attribute tối đa 2048kb',
            'product_images.max' => ':attribute tối đa 2048kb',
            'product_slug.required' => ':attribute không được để trống',
            'product_slug.string' => ':attribute không đúng định dạng'
        ];
    }
    public function attributes()
    {
        return [
            'product_name' => 'Tên sản phẩm',
            'product_desc' => 'Chi tiết sản phẩm',
            'product_price' => 'Giá sản phẩm',
            'product_detail' => 'Chi tiết sản phẩm',
            'product_cate' => 'Danh mục',
            'product_thumb' => 'Ảnh đại diện',
            'product_images' => 'Ảnh chi tiết',
            'product_slug' => 'Slug',
        ];
    }
}
