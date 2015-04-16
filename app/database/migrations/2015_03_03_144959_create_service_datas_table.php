<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceDatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_datas', function(Blueprint $table)
		{
			$table->increments('id');

            $table->enum('status', ['Pendiente', 'Proceso', 'Terminado']); //, 'Autorización'

            $table->string('equipment');
            $table->string('mark');
            $table->string('model');
            $table->string('series');
            $table->mediumText('details');

            $table->text('observations');
            $table->text('internal');

            $table->unsignedInteger('warranty_id');

            $table->unsignedInteger('sale_id');
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
		Schema::drop('service_datas');
	}

}
