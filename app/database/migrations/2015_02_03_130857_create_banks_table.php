<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('banks', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('number_account');
			$table->string('branch');
			$table->string('clabe');

			$table->string('executive_name'); // nombre y apellidos
			$table->string('phone');

			$table->string('country');
			$table->string('state');
			$table->string('city');
			$table->string('postcode', 10);
			$table->string('colony');
			$table->string('address');

			$table->boolean('terminal');
			$table->decimal('commission_debit', '15', '2');
			$table->decimal('commission_credit', '15', '2');

			$table->string('slug');
			$table->tinyInteger('active');    // 0=suspendido; 1=activo

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
		Schema::drop('banks');
	}

}
