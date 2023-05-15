<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'thickness',
        'height',
        'width',
        'status',
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }
}
