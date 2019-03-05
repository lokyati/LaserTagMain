<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->unsignedInteger('package_id');
            $table->foreign('package_id')->references('id')->on('package');
            $table->integer('players');
            $table->integer('reservation_date');
            $table->integer('reservation_time');
            $table->integer('tel');
            $table->string('email')->unique();
            $table->string('note');
            $table->integer('bonus_used');
            $table->float('price');
            $table->boolean('paid_status');
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
        Schema::dropIfExists('reservations');
    }
}
