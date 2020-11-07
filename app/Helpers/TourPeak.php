<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class TourPeak extends Model
{
    protected $table = 'tour_peak';

     protected $fillable = [
        'tour',
        'from',
        'to',
        'type',
        'amount',
    ];
}
