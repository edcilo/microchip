<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');

            $table->string('folio');
            $table->enum('status', ['En proceso...', 'Pagado', 'Pendiente', 'Cancelado']);
            $table->date('date');
            $table->date('reception_date');

            $table->decimal('iva', '15', '2');
            $table->string('bill_scan');

            $table->boolean('progress_1'); // factura pagada
            $table->boolean('progress_2'); // subir archivo escaneado
            $table->boolean('progress_3'); // terminar la alta de numeros de serie
            $table->boolean('progress_4'); // termino de alta de productos
            $table->boolean('progress_5'); // termino de revision de precios

            $table->integer('provider_id')->unsigned();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('no action')->onUpdate('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('purchases');
    }
}
