<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

     protected $fillable = [
        'activity',
        'subject',
        'user',
    ];
}
