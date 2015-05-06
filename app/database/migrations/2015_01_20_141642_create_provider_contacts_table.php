<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('provider_contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name', 120);
            $table->string('last_name', 120);
            $table->string('job', 120);
            $table->string('phone');
            $table->string('email');

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
        Schema::drop('provider_contacts');
    }
}
