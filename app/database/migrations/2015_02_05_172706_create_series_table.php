<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('series', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('ns');
			$table->enum('status', ['Disponible', 'Vendido', 'Garantía', 'Baja', 'Apartado']);
			$table->boolean('generate');
			$table->date('date_warranty');

			$table->integer('movement_out')->unsigned();
            $table->integer('separated_id')->unsigned();

			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('no action')->onUpdate('cascade');

			$table->integer('inventory_movement_id')->unsigned();
			$table->foreign('inventory_movement_id')->references('id')->on('inventory_movements')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::drop('series');
	}

}
