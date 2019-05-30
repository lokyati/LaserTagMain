<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Matches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('matches', function (Blueprint $table) {
            $table->increments('id')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('score')->nullable();
            $table->bigInteger('all_shot')->nullable();
            $table->bigInteger('all_hit')->nullable();
            $table->bigInteger('all_out')->nullable();
            $table->double('acc')->nullable();
            $table->bigInteger('bonus')->nullable();
            $table->date('match_date')->nullable();
            $table->integer('placed')->nullable();
            $table->string('result')->nullable();
            $table->boolean('processed')->nullable();
            $table->timestamps();
        });

        Schema::table('matches', function($table){
            //$table->foreign('match_id')->references('id')->on('matches');
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
        Schema::dropIfExists('matches');
    }
}
