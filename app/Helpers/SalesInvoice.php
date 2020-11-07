<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    protected $table = 'sales_invoice';

     protected $fillable = [
        'sales_invoice',
        'reservation_officer',
        'agent',
        'email',
        'booking_reference',
        'lead_guest',
        'pickup',
        'time',
        'total',
        'vat',
        'status',
    ];
}
