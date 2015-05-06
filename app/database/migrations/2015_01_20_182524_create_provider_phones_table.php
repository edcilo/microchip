<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderPhonesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('provider_phones', function (Blueprint $table) {
            $table->increments('id');

            $table->string('phone');

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('provider_phones');
    }
}
