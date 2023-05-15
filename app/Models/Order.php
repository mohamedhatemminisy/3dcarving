<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
        'added_by',
        'customer_id',
        'status',
        'price',
        'pricing_status',
        'price_approved_at',
        'designer_id',
        'design_status',
        'design_start_at',
        'design_compelete_at',
        'operation_status',
        'operation_hold_reason',
        'machine_type_id',
        'accountant_id',
        'machine_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'price_approved_at',
        'design_start_at',
        'design_compelete_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }
    public function accountant()
    {
        return $this->belongsTo(User::class, 'accountant_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
    public function machine_type()
    {
        return $this->belongsTo(MachineType::class, 'machine_type_id');
    }   
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    public function OrderMaterial(){
        return $this->hasOne(OrderMaterial::class);
    }

    public function files()
    {
        return $this->hasMany(OrderFiles::class);
    }

    public function unit()
    {
        return $this->hasMany(Unit::class);
    }

    
}
