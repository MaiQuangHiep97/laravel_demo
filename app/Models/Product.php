<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_thumb',
        'product_desc',
        'product_price',
        'product_detail',
        'cate_id',
        'admin_id',
    ];
    public function product_image(){
        return $this->hasMany('App\Models\Product_Image');
    }
    public function order_products(){
        return $this->hasMany('App\Models\OrderProduct');
    }
}
