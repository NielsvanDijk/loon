<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewDatabaseStructureCaosSteps extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caos_steps', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cao_id')->unsigned();
			$table->string('category');
			$table->float('percent');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('caos_steps');
	}

}