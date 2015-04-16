<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name');
			$table->string('f_last_name');
			$table->string('s_last_name');
			$table->string('photo');
			$table->date('birthday');
			$table->enum('sex', ['Masculino', 'Femenino']);

			$table->string('phone');
			$table->string('cellphone');
			$table->string('email');

			$table->string('country');
			$table->string('state');
			$table->integer('postcode');
			$table->string('city');
			$table->string('colony');
			$table->string('address');

			$table->enum('marital_status', ['Casado', 'Soltero']);
			$table->string('wife');

			$table->string('reference_1');
			$table->string('reference_2');
			$table->string('reference_3');

			$table->string('ref_phone_1');
			$table->string('ref_phone_2');
			$table->string('ref_phone_3');

			$table->date('hired');
			$table->decimal('salary', '15', '2');
			$table->decimal('commission', '15', '2');
			$table->decimal('goal', '15', '2');
			$table->decimal('current', '15', '2');

			$table->date('fired');
			$table->text('reason');

			$table->text('observations');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::drop('profiles');
	}

}
