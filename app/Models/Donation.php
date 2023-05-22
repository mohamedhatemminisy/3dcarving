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
}









