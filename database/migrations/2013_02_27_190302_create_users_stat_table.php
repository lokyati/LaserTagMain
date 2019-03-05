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
            $table->integer('all_shot');
            $table->integer('all_hit');
            $table->integer('all_acc');
            $table->integer('matches');
            $table->float('avg_shot');
            $table->float('avg_acc');
            $table->float('avg_hit');
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
        Schema::dropIfExists('users_stat');
    }
}
