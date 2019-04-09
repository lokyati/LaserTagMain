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
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            $table->integer('day')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->integer('players')->nullable();
            $table->integer('tel')->nullable();
            $table->text('note')->nullable();
            //$table->integer('bonus_used');
            //$table->double('price');
            //$table->boolean('paid_status');
            $table->timestamps();
        });

        Schema::table('reservations', function($table){
            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('package_id')->references('id')->on('package');
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
