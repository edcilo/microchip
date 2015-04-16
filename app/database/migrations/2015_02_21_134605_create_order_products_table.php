<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_products', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('quantity');
            $table->decimal('selling_price', 10, 2);

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('support_id');

            $table->unsignedInteger('pending_movement_id');
            //$table->foreign('pending_movement_id')->references('pending_movements')->on('id')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action')->onUpdate('cascade');

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
		Schema::drop('order_products');
	}

}
