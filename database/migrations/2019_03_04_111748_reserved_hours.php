<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReservedHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('reserved_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reservation_id')->nullable();
            $table->integer('hour')->nullable();
            $table->timestamps();
        });

       Schema::table('reserved_hours', function($table){
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserved_hours');
    }
}
