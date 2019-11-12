<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthItemChilds extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth_item_childs', function (Blueprint $table) {
			$table->string('parent');
			$table->string('child');
			$table->unsignedTinyInteger('child_type')->default(0); // 0: route, 1: Permission, 2: Role
			$table->primary(['parent', 'child']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('auth_item_childs');
	}
}
