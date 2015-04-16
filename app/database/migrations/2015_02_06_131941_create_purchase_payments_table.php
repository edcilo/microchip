<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchase_payments', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('purchase_id')->unsigned();
			$table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('cascade');

			$table->integer('cheque_id')->unsigned();

			$table->enum('method', ['Contado', 'Crédito']);
			$table->string('type');
			$table->date('payment_date');
			$table->enum('status', ['Pagado', 'Pendiente']);

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
		Schema::drop('purchase_payments');
	}

}
