<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'whatsapp',
        'phone',
        'address',
        'last_order_date',
        'added_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
