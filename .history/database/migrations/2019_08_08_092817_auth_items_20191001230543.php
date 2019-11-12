<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthItems extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth_items', function (Blueprint $table) {
			$table->string('name');
			$table->unsignedTinyInteger('type')->default(0); // 0: route, 1: Permission, 2x: Role (20: SuperAdmin, 21: Admin, 22: User, 29: Guest)
			$table->primary(['name']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('auth_items');
	}
}
