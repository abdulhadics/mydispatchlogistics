<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'load_id',
        'driver_id',
        'amount',
        'payment_type',
        'status',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function load()
    {
        return $this->belongsTo(Load::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}
