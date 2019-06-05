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
            $table->bigInteger('all_shot')->default('0');
            $table->bigInteger('all_hit')->default('0');
            $table->bigInteger('all_out')->default('0');
            $table->bigInteger('matches')->default('0');
            $table->bigInteger('wins')->default('0');
            $table->bigInteger('loses')->default('0');
            $table->integer('bestplace')->default('0');
            $table->double('avg_shot')->default('0');
            $table->double('avg_acc')->default('0');
            $table->double('avg_hit')->default('0');
            $table->integer('lvl')->default('1');
            $table->integer('experience')->default('0');
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
