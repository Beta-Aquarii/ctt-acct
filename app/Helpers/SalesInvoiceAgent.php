<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Model;

class SalesInvoiceAgent extends Model
{
    protected $table = 'sales_invoice_agent';

     protected $fillable = [
        'si_id',
        'agent_id',
        'name',
        'address',
        'tin',
        'contract_rate',
        'payment_terms',
        'notes',
        'nature',
    ];
}
