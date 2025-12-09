<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    protected $fillable = [
        'load_number',
        'pickup_location',
        'delivery_location',
        'pickup_date',
        'delivery_date',
        'weight',
        'miles',
        'rate',
        'equipment_type',
        'special_requirements',
        'customer_id',
        'driver_id',
        'dispatcher_id',
        'status',
    ];

    protected $casts = [
        'pickup_date' => 'datetime',
        'delivery_date' => 'datetime',
        'weight' => 'decimal:2',
        'miles' => 'decimal:2',
        'rate' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function dispatcher()
    {
        return $this->belongsTo(User::class, 'dispatcher_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
