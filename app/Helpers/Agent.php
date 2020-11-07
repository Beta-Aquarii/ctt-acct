<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agents';

     protected $fillable = [
        'name',
        'nature',
        'address',
        'tin',
        'contract_rate',
        'payment_terms',
        'status',
    ];
}
