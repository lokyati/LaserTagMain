<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_users', function (Blueprint $table) {
            $table->increments('id');
            $table->text('warname');
            $table->unsignedInteger('guest_token_id');
            $table->integer('score');
            $table->bigInteger('all_shot');
            $table->bigInteger('all_hit');
            $table->bigInteger('all_acc');
            $table->bigInteger('bonus');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('guest_users', function($table){
            $table->foreign('guest_token_id')->references('id')->on('guest_token');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_users');
    }
}
