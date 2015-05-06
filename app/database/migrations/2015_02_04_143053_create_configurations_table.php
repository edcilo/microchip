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
