<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'collection_date',
        'start_date',
        'end_date',
        'price',
        'address',
        'added_by',
        'donator_id',
        'party_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function donator()
    {
        return $this->belongsTo(User::class, 'donator_id');
    }

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}









