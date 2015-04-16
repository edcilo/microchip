<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('username');
			$table->string('password')->unique();
			$table->string('remember_token')->nullable();
			$table->string('slug');
			$table->tinyInteger('active');

			$table->integer('department_id')->unsigned();
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('no action')->onUpdate('cascade');

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
		Schema::drop('users');
	}

}
