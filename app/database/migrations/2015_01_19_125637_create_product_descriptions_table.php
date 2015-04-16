<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductDescriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_descriptions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('model', 120);
			$table->boolean('have_series');
			$table->decimal('purchase_price');
			$table->string('data_sheet');
			$table->boolean('box');
			$table->integer('pieces');
			$table->integer('stock_min');
			$table->integer('stock_max');
			$table->integer('quantity');
			$table->string('provider', 120);
			$table->string('provider_barcode', 120);
			$table->integer('provider_warranty');

			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('no action')->onUpdate('cascade');

			$table->integer('mark_id')->unsigned();
			$table->foreign('mark_id')->references('id')->on('marks')->onDelete('no action')->onUpdate('cascade');

			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');

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
		Schema::drop('product_descriptions');
	}

}
