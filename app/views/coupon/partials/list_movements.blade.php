<table>
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($coupon->sale->movements as $movement)
        <tr>
            <td class="text-right">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode}}</td>
            <td>{{ $movement->product->s_description }}</td>
            <td class="text-right">$
                @if($coupon->sale->new_price == 0)
                    {{ $movement->selling_price_without_iva_f }}
                @else
                    {{ $movement->selling_price_w_i_p }}
                @endif
            </td>
            <td class="text-right">$
                @if($coupon->sale->new_price == 0)
                    {{ $movement->total_without_iva_f }}</td>
            @else
                {{ $movement->total_price_w_i_p }}
            @endif
        </tr>
        @if($movement->product->type == 'Producto')
            @if($movement->product->p_description->have_series)
                <tr>
                    <td></td>
                    <td colspan="2"><strong>S/N</strong>
                        @foreach( $movement->seriesOut as $series )
                            {{ $series->ns }};
                        @endforeach
                    </td>
                    <td colspan="2"></td>
                </tr>
            @endif
        @endif
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Total:</strong></td>
        @if( $coupon->sale->new_price == 0 )
            <td>$ {{ $coupon->sale->total_f }}</td>
        @else
            <td>$ {{ $coupon->sale->total_p }}</td>
        @endif
    </tr>
    </tfoot>
</table>