<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_stat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->bigInteger('all_shot');
            $table->bigInteger('all_hit');
            $table->bigInteger('all_acc');
            $table->bigInteger('matches');
            $table->bigInteger('wins');
            $table->bigInteger('loses');
            $table->double('avg_shot');
            $table->double('avg_acc');
            $table->double('avg_hit');
        });

        Schema::table('users_stat', function($table){
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_stat');
    }
}
