<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProvidersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('providers', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name', 255);
			$table->string('rfc', 255);
			$table->string('email', 255);
			$table->string('number');
			$table->string('classification', 255);
			$table->string('state', 255);
			$table->string('city', 255);
			$table->integer('postcode');
			$table->string('address');
			$table->string('address_warranty');
			$table->integer('days_credit');
			$table->decimal('credit_limit');
			$table->text('observations');
			$table->boolean('active');
			$table->string('slug', 255);

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
		Schema::drop('providers');
	}

}
