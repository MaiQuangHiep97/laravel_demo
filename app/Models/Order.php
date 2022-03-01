<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'code',
        'payment',
        'total_price',
        'user_id',
        'address_id',
    ];
    public function order_products(){
        return $this->hasMany('App\Models\OrderProduct');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
