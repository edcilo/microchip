<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInventoryMovementPurchaseTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventory_movement_purchase', function (Blueprint $table) {
            $table->integer('inventory_movement_id')->unsigned();
            $table->foreign('inventory_movement_id')->references('id')->on('inventory_movements')->onDelete('cascade')->onUpdate('cascade');

            $table->integer('purchase_id')->unsigned();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('inventory_movement_purchase');
    }
}
