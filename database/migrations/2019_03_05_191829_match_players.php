<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_players', function (Blueprint $table) {
            $table->increments('id');
            //$table->unsignedInteger('match_id');
            //$table->unsignedInteger('user_id');
            $table->integer('score');
            $table->bigInteger('all_shot');
            $table->bigInteger('all_hit');
            $table->bigInteger('all_acc');
            $table->bigInteger('bonus');
        });

        /*Schema::table('match_players', function($table){
            $table->foreign('match_id')->references('id')->on('matches');
            $table->foreign('user_id')->references('id')->on('users');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_players');
    }
}
