<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_stat', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('login_today');
            $table->bigInteger('login_all');
            $table->bigInteger('logged_in');
            $table->bigInteger('reservations_today');
            $table->bigInteger('reservations_all');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_stat');
    }
}
