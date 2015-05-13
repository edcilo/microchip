<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponPurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupon_purchases', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('folio');
            $table->float('value');
            $table->string('observations');
            $table->unsignedInteger('provider_id');
            $table->unsignedInteger('warranty_id');

            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade');
            $table->foreign('warranty_id')->references('id')->on('warranties')->onDelete('cascade');
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
		Schema::drop('coupon_purchases');
	}

}
