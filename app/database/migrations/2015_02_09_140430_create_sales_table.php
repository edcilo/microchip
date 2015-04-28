<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sales', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('folio');

			$table->decimal('iva', 5, 2);
            $table->decimal('dollar', 10, 2);

			$table->enum('type', ['Ticket', 'Factura']);
			$table->enum('classification', ['Venta','Cotización','Pedido','Servicio']);
			$table->enum('status', ['Pendiente', 'Emitido', 'Pagado', 'Cancelado']);
			$table->text('description');
			$table->decimal('new_price', 10, 2)->default(0);
            $table->boolean('repayment')->default(0);

            $table->decimal('advance');             // anticipo
            $table->date('delivery_date');          // fecha de entrega
            $table->time('delivery_time');          // hora de entrega
            $table->mediumText('shipping_address'); // direccion de entrega

            $table->boolean('sale')->default(0);
            $table->boolean('separated')->default(0);
            $table->boolean('price')->default(0);
            $table->boolean('service')->default(0);

            $table->integer('customer_order')->unsigned();

			$table->boolean('movements_end')->default(0);
			$table->boolean('series_end')->default(1);

			$table->integer('customer_id')->unsigned();
			$table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action')->onUpdate('cascade');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('cascade');

			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sales');
	}

}
