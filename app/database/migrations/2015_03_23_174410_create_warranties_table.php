<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('warranties', function (Blueprint $table) {
            $table->increments('id');

            $table->enum('status', ['Pendiente', 'Enviado', 'Terminado'])->default('Pendiente');
            $table->string('former_status');
            $table->text('description');
            $table->date('sent_at')->nullable();
            $table->text('observations');

            $table->unsignedInteger('series_id');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('no action');

            $table->unsignedInteger('sale_id');
            $table->unsignedInteger('service_id');

            $table->unsignedInteger('purchase_id');
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('no action');

            $table->unsignedInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('no action');

            $table->unsignedInteger('sent_by');

            $table->unsignedInteger('movement_out');
            $table->unsignedInteger('movement_in');

            $table->tinyInteger('solution', false, true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('warranties');
    }
}
