<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class SalesInvoiceParticular extends Model
{
    protected $table = 'sales_invoice_particular';

     protected $fillable = [
        'si_id',
        'lead_guest',
        'tour_date',
        'particular',
        'particular_id',
        'particular_type',
        'pax',
        'foreign_pax',
        'rate',
        'foreign_rate',
        'commission',
        'booking_reference',
    ];
}
