<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');

            $table->string('barcode');
            $table->enum('type', ['Producto', 'Servicio']);
            $table->string('s_description');
            $table->text('description');
            $table->string('image');
            $table->decimal('price_1', 10, 2);
            $table->decimal('price_2', 10, 2);
            $table->decimal('price_3', 10, 2);
            $table->decimal('price_4', 10, 2);
            $table->decimal('price_5', 10, 2);
            $table->tinyInteger('offer');
            $table->decimal('points');
            $table->decimal('r_points');
            $table->integer('warranty');
            $table->boolean('web');
            $table->boolean('active');
            $table->string('slug');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('products');
    }
}
