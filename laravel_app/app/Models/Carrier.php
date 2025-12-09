<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'company_name',
        'mc_number',
        'dot_number',
        'contact_name',
        'email',
        'phone',
        'equipment_type',
    ];
}
