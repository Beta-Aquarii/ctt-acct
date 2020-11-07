<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class AgentContact extends Model
{
    protected $table = 'agents_contact';

     protected $fillable = [
        'agent',
        'name',
        'designation',
        'email',
        'contact_number',
        'status',
    ];
}
