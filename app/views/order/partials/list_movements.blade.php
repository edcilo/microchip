<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Total</th>
        <th><i class="fa fa-gears"></i></th>
    </tr>
    </thead>
    <tbody>
    @if(count($sale->pas))
        <tr>
            <td colspan="6"><strong>Productos cotizados</strong></td>
        </tr>
    @endif
    @foreach($sale->pas as $movement)
        @if($movement->status != 'Surtido' AND $movement->productOrder AND !$movement->soft_delete)
            <tr>
                <td>{{ $movement->barcode }}</td>
                <td>{{ $movement->s_description }}</td>
                <td class="text-right">{{ $movement->quantity }}</td>
                <td class="text-right">$ {{ $movement->selling_price_f }}</td>
                <td class="text-right">$ {{ $movement->total_f }}</td>
                <td class="text-right">
                    @if( !$sale->movements_end )
                        @if(!is_object($movement->product))
                            @include('pa.partials.btn_edit', ['pa' => $movement])
                        @endif

                        @include('movement.partials.form_destroy_order')
                    @endif
                </td>
            </tr>
        @endif
    @endforeach()
    @if ($sale->status == 'Emitido' AND count($sale->orderProducts))
        <tr>
            <td colspan="6"><strong>Productos surtidos</strong></td>
        </tr>
        @foreach($sale->order_products as $movement)
            <tr class="{{ $movement->class_row_series }}">
                <td>{{ $movement->product->barcode }}</td>
                <td>{{ $movement->product->s_description}}</td>
                <td class="text-right">{{ $movement->quantity }}</td>
                <td class="text-right">$ {{ $movement->selling_price_f }}</td>
                <td class="text-right">$ {{ $movement->total_f }}</td>
                <td class="text-right">
                    @include('order.partials.btn_series')

                    @include('order.partials.btn_supply', ['pa' => $movement->pa])
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td class="text-right">Total:</td>
        <td class="text-right">$ {{ $sale->total_order_f }}</td>
        <td></td>
    </tr>
    </tfoot>
</table>
