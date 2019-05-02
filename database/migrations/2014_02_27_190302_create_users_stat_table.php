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
            $table->bigInteger('all_shot')->nullable();
            $table->bigInteger('all_hit')->nullable();
            $table->bigInteger('all_out')->nullable();
            $table->bigInteger('matches')->nullable();
            $table->bigInteger('wins')->nullable();
            $table->bigInteger('loses')->nullable();
            $table->integer('bestplace')->nullable();
            $table->double('avg_shot')->nullable();
            $table->double('avg_acc')->nullable();
            $table->double('avg_hit')->nullable();
            $table->integer('lvl')->nullable();
            $table->integer('experience')->nullable();
            $table->timestamps();
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
