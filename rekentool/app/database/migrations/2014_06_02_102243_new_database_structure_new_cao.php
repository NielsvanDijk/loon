<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewDatabaseStructureNewCao extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
		Schema::drop('caos');
		Schema::drop('salaries');

		Schema::create('caos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name',255);
			$table->float('wage');
			$table->integer('duration')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('caos');
	}

}
