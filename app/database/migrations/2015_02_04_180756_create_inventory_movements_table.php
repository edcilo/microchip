<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryMovementsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action')->onUpdate('cascade');

            $table->integer('warranty');

            $table->integer('in_stock');
            $table->integer('quantity');
            $table->enum('status', ['in', 'out', 'cancel']);
            $table->decimal('purchase_price', '15', '2');
            $table->decimal('selling_price', '15', '2');
            $table->string('description');

            $table->unsignedInteger('movement_in_id');
            $table->unsignedInteger('q_warranty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('inventory_movements');
    }
}
