<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('quantity')->unsigned();

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');

            $table->unsignedInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('no action');

            $table->unsignedInteger('series_id');

            $table->unsignedInteger('sale_id');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('no action');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('warranties');
    }
}
