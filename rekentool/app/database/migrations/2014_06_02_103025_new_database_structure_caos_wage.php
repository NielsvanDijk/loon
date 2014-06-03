<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewDatabaseStructureCaosWage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caos_wage', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cao_id')->unsigned();
			$table->integer('age')->unsigned();
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
		Schema::drop('caos_wage');
	}

}
