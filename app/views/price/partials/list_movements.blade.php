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
    @foreach($sale->pas as $pa)

            <tr>
                <td>{{ $pa->barcode }}</td>
                <td>{{ $pa->s_description }}</td>
                <td class="text-right">{{ $pa->quantity }}</td>
                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                <td class="text-right">$ {{ $pa->total_f }}</td>
                <td class="text-right">
                    @if( ! $sale->movements_end )
                        @if(!is_object($pa->product))
                            @include('pa.partials.btn_edit')
                        @endif

                        @include('movement.partials.form_destroy_price')

                    @endif
                </td>
            </tr>

    @endforeach()
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td>Total:</td>
        <td class="text-right">$ {{ $sale->total_price_f }}</td>
        <td></td>
    </tr>
    </tfoot>
</table>
