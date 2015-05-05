<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pays', function(Blueprint $table)
		{
			$table->increments('id');

            $table->decimal('amount');
            $table->decimal('change');
            $table->boolean('pending');
            $table->string('description');

            $table->enum('method', ['Efectivo', 'Tarjeta de crédito/débito', 'Cheque', 'Transferencia', 'Vale', 'Monedero']);

            $table->string('reference');
            $table->string('entity');

            $table->boolean('change_check')->default(0);
            $table->unsignedInteger('user_receiving_id');

            $table->unsignedInteger('sale_id');
            //$table->foreign('sale_id')->references('id')->on('sales')->onDelete('no action')->onUpdate('cascade');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade');

            $table->unsignedInteger('coupon_id');

            $table->date('date');
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
		Schema::drop('pays');
	}

}
