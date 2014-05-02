<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewSalaries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('salaries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cao_id', 11)->unsigned();
			$table->integer('age', 2)->unsigned();
			$table->string('catagory', 2);
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
		Schema::drop('salaries');
	}

}
