<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

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
            $table->uuid('id')->primary();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->string('email');
            $table->tinyInteger('gender')->nullable(); // 0: female, 1: male, 2 or null: other
            $table->date('birthday')->nullable();
            $table->string('phone');
            $table->string('password')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_name')->nullable();
            $table->string('device_token')->nullable(); // For mobile app
            $table->tinyInteger('status')->default(0); // 10: Active, 0: In-active
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->uuid('image_id')->nullable();
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
        Schema::dropIfExists('users');
    }
}
