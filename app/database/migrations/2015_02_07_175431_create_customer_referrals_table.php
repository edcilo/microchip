<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerReferralsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer_referrals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('cascade');

            $table->integer('referred_id')->unsigned();
            $table->foreign('referred_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('cascade');

            $table->text('observations');
            $table->integer('expiration')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('customer_referrals');
    }
}
