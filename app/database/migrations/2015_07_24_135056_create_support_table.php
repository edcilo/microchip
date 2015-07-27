<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSupportTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('support', function(Blueprint $table)
		{
			$table->increments('id');
            $table->unsignedInteger('product_id');
			$table->unsignedInteger('authorized_by');
			$table->unsignedInteger('given_by');
			$table->unsignedInteger('received_by');
			$table->enum('status', ['Gasto', 'Uso', 'Prestamo', 'Devuelto']);
			$table->string('observations');
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
		Schema::drop('support');
	}

}
