<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_blocks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('mac_address');
            $table->string('device_name');
            $table->integer('count')->comment('Number of enter wrong phone number')->default(1);
            $table->tinyInteger('is_block')->default(0)->comment('0: available; 1: blocked');
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
        Schema::dropIfExists('device_blocks');
    }
}
