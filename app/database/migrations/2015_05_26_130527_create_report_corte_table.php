<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportCorteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_corte', function(Blueprint $table)
		{
			$table->increments('id');
            $table->boolean('close');
            $table->date('date_init');
            $table->time('time_init')->nullable();
            $table->date('date_end')->nullable();
            $table->time('time_end')->nullable();
            $table->unsignedInteger('pay_id');

            $table->integer('quantity_1000');
            $table->integer('quantity_500');
            $table->integer('quantity_200');
            $table->integer('quantity_100');
            $table->integer('quantity_50');
            $table->integer('quantity_20');
            $table->integer('quantity_10');
            $table->integer('quantity_5');
            $table->integer('quantity_2');
            $table->integer('quantity_1');
            $table->integer('quantity_05');

            $table->integer('quantity_r_1000');
            $table->integer('quantity_r_500');
            $table->integer('quantity_r_200');
            $table->integer('quantity_r_100');
            $table->integer('quantity_r_50');
            $table->integer('quantity_r_20');
            $table->integer('quantity_r_10');
            $table->integer('quantity_r_5');
            $table->integer('quantity_r_2');
            $table->integer('quantity_r_1');
            $table->integer('quantity_r_05');

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
		Schema::drop('report_corte');
	}

}
