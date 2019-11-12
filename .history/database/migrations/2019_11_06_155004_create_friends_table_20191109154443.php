<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('user_one');
            $table->uuid('user_two');
            $table->tinyInteger('status');
            $table->uuid('action_user');
            $table->foreign('user_one')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_two')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('action_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('friends');
    }
}
