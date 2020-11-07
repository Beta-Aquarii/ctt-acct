<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sales_invoice');
            $table->string('reservation_officer');
            $table->string('agent');
            $table->string('contact');
            $table->string('tin');
            $table->string('address');
            $table->string('booking_reference');
            $table->string('lead_guest');
            $table->boolean('pax');
            $table->integer('rate');
            $table->integer('tour');
            $table->string('tour_date');
            $table->string('vat');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_invoice');
    }
}
