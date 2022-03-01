<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infomation extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'address',
        'gender',
        'infomationable_id',
        'infomationable_type',
    ];
    public function infomationable()
    {
        return $this->morphTo();
    }
}
