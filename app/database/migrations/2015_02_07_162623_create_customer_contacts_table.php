<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerContactsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_contacts', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('cascade');

            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('customer_contacts');
    }
}
