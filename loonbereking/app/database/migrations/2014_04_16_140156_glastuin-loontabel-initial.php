<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GlastuinLoontabelInitial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('glastuinloontabel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('age', 2);
			$table->string('group', 1);
			$table->string('value', 6);
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
		Schema::drop('glastuinloontabel');
	}
}
