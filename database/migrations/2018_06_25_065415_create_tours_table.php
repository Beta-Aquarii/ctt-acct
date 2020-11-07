<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('type');
            $table->string('code');
            $table->boolean('duration');
            $table->boolean('lead_time');
            $table->boolean('min_pax');
            $table->integer('foreign_rate');
            $table->text('description');
            $table->text('inclusions');
            $table->text('highlights');
            $table->text('pick_up');
            $table->boolean('status');
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
        Schema::dropIfExists('tours');
    }
}
