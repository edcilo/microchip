<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePendingMovementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pending_movements', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('barcode');
            $table->string('s_description');
            $table->mediumText('l_description');
            $table->string('provider_link');
            $table->string('image_link');
            $table->integer('quantity');
            $table->integer('quantity_price');
            $table->decimal('selling_price', 10, 2);
            $table->boolean('w_iva')->default(0);
            $table->boolean('dollar')->default(0);
            $table->decimal('utility', 10, 2);
            $table->decimal('shipping', 10, 2);

            $table->boolean('soft_delete')->default(0);
            $table->boolean('productOrder')->default(1);
            $table->boolean('productPrice')->deafault(0);

            $table->enum('status', ['Pendiente', 'Surtido']);

            $table->integer('product_id')->unsigned()->default(0);

            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::drop('pending_movements');
	}

}
