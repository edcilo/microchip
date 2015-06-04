<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentConceptsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_concepts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('concept');
            $table->boolean('spending');
            $table->enum('document', ['Venta', 'Pedido', 'Servicio']);
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
		Schema::drop('payment_concepts');
	}

}
