<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->float('distance')->nullable();
            $table->time('duration')->nullable();
            $table->integer('calories')->nullable();
            $table->time('average_pace')->nullable();
            $table->float('average_speed')->nullable();
            $table->float('max_speed')->nullable();
            $table->time('start_time')->nullable();
            $table->date('date')->nullable();
            $table->uuid('user_id');
            $table->uuid('challenge_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('activities');
    }
}
