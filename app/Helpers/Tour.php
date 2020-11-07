<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    
    protected $table = 'tours';

     protected $fillable = [
        'name',
        'type',
        'code',
        'lead_time',
        'foreign_rate',
        'description',
        'inclusions',
        'highlights',
        'pickup',
    ];
}
