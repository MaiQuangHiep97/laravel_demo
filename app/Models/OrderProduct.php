<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'product_id',
        'order_id',
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
