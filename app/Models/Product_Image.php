<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    use HasFactory;
    public $table = "product_images";
    protected $fillable = [
        'url_image',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
