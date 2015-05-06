<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('owner');
            $table->string('rfc');
            $table->string('photo');

            $table->string('state');
            $table->string('city');
            $table->string('colony');
            $table->string('address');

            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('phone_3');
            $table->string('email');
            $table->string('web');

            $table->string('services');
            $table->string('schedule');
            $table->text('note');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('companies');
    }
}
