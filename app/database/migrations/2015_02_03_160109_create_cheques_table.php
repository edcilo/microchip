<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');

            $table->string('folio');

            $table->date('payment_date')->nullable();
            $table->decimal('amount', '15', '2');
            $table->string('receiver', 120);

            $table->text('concept');
            $table->enum('status', ['Disponible', 'Pagado', 'Post-fechado', 'Cancelado', 'Elaborado', 'Parcial']);
            $table->boolean('message');

            $table->boolean('active');
            $table->text('observations');

            $table->integer('bank_id')->unsigned();
            $table->index('bank_id');
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('no action')->onUpdate('cascade');

            $table->integer('bank_count_id')->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('cheques');
    }
}
