<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            //$table->unsignedInteger('rank_id')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('lvl')->nullable();
            //$table->integer('tel')->nullable();
            $table->integer('battle_point_balance')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        /*Schema::table('users', function($table){
            $table->foreign('rank_id')->references('id')->on('ranks');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
