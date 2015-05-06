<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryMovementSaleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_movement_sale', function (Blueprint $table) {
            $table->integer('inventory_movement_id')->unsigned();
            $table->foreign('inventory_movement_id')->references('id')->on('inventory_movements')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('movement_in')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('inventory_movement_sale');
    }
}
