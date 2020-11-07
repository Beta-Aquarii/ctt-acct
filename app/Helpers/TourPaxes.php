<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class TourPaxes extends Model
{
    protected $table = 'tours_paxes';

     protected $fillable = [
        'tour',
        'with_guide',
        'without_guide',
        'pax',
        'amount',
    ];
}
