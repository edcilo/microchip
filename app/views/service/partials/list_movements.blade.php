<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Total</th>
        @if( !$sale->movements_end )
            <th><i class="fa fa-gears"></i></th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($sale->pas as $pa)
        @if($pa->productPrice)
            <tr>
                <td>{{ $pa->barcode }}</td>
                <td>{{ $pa->s_description }}</td>
                <td class="text-right">{{ $pa->quantity }}</td>
                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                <td class="text-right">$ {{ $pa->total_f }}</td>
                @if( !$sale->movements_end )
                    <td class="text-right">
                        @include('movement.partials.form_destroy_service')
                    </td>
                @endif
            </tr>
        @endif
    @endforeach()
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td class="text-right">Total (I.V.A. incluido):</td>
        <td class="text-right">$ {{ $sale->total_price_f }}</td>
        @if( !$sale->movements_end )
            <td></td>
        @endif
    </tr>
    </tfoot>
</table>

