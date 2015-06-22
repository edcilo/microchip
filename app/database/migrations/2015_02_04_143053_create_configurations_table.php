<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('iva', 4, 2);
            $table->decimal('dollar');
            $table->unsignedInteger('coupon_effective_days');
            $table->text('coupon_terms_use');

            $table->decimal('width_paper_barcode');
            $table->decimal('height_paper_barcode');
            $table->decimal('width_bar_document_barcode');
            $table->decimal('height_document_barcode');
            $table->decimal('width_bar_product_barcode');
            $table->decimal('height_product_barcode');
            $table->decimal('width_bar_series_barcode');
            $table->decimal('height_series_barcode');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('configurations');
    }
}
