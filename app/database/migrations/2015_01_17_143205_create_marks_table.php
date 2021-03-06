<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('image');
            $table->text('description');
            $table->string('slug');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('marks');
    }
}
