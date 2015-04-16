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
    @foreach($sale->movements as $movement)
        <tr>
            <td>{{ $movement->product->barcode }}</td>
            <td>{{ $movement->product->s_description }}</td>
            <td class="text-right">{{ $movement->quantity }}</td>
            <td class="text-right">$ {{ $movement->selling_price_f }}</td>
            <td class="text-right">$ {{ $movement->total_f }}</td>
            <td class="text-right">
                @if($movement->product->p_description)

                    @if( $movement->product->p_description->have_series )

                        @include('series.partials.btn_create_sale')

                    @endif

                @endif

                @include('movement.partials.btn_show_product')

                @if(!$sale->movements_end)

                    @include('movement.partials.form_destroy_sale')

                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td class="text-right">Total:</td>
        <td class="text-right">$ {{ $sale->total_f }}</td>
        <td></td>
    </tr>
    </tfoot>
</table>