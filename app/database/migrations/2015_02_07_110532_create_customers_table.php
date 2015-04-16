<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('prefix');
			$table->string('name');

			$table->string('country');
			$table->string('state');
			$table->string('city');
			$table->string('postcode');
			$table->string('colony');
			$table->string('address');
            $table->mediumText('shipping_address');

			$table->date('birthday');

			$table->string('phone');
			$table->string('cellphone');

			$table->string('email');
			$table->string('rfc');

			$table->decimal('credit_limit', '15', '2');
			$table->integer('credit_days');

			$table->enum('classification', ['Distribuidor', 'Cliente']);
			$table->enum('legal_concept', ['Ninguno', 'Persona Física', 'Persona Moral']);

			$table->string('card_id');
			$table->decimal('points', '15', '2');
			$table->integer('expiration')->unsigned();
			$table->date('card_active');

			$table->string('slug');
			$table->tinyInteger('active');

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
		Schema::drop('customers');
	}

}
