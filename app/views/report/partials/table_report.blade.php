@if( $user->pays()->where('method', $method)->count() )

    <strong>Cobro con {{ $method }}</strong>

    <table class="table">
        <thead>
        <tr>
            <th>Folio</th>
            <th>Documento</th>
            <th>Tipo de pago</th>
            <th>Total</th>
            <th>Cobrado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->pays as $pay)
            @if($pay->method == $method)
                <tr class="@if($pay->amount < 0) red @endif">
                    <td class="text-center">
                        @if(!is_null($pay->sale))
                            <a href="
                            @if ($pay->sale->classification == 'Venta')
                            {{ route('sale.show', $pay->sale->id) }}
                            @elseif($pay->sale->classification == 'Pedido')
                            {{ route('order.show', $pay->sale->id) }}
                            @elseif($pay->sale->classification == 'Servicio')
                            {{ route('service.show', $pay->sale->id) }}
                            @endif
                                    ">
                                {{ $pay->sale->folio }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if(!is_null($pay->sale))
                            {{ $pay->sale->classification }}
                        @else
                            {{ $pay->description }}
                        @endif
                    </td>
                    <td>
                        {{ $pay->method }}
                    </td>
                    <td class="text-right">
                        @if(!is_null($pay->sale))
                            $
                            @if ($pay->sale->classification == 'Venta')
                                {{ $pay->sale->total_f }}
                            @elseif($pay->sale->classification == 'Pedido')
                                {{ $pay->sale->total_order_f }}
                            @elseif($pay->sale->classification == 'Servicio')
                                {{ $pay->sale->total_price_f }}
                            @endif
                        @endif
                    </td>
                    <td class="text-right">
                        <?php $subtotal = $pay->amount - $pay->change; $total += $subtotal ?>
                        ${{ number_format($subtotal , 2, '.', ',') }}
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3"></td>
            <td class="text-right">
                <strong>Total:</strong>
            </td>
            <td class="text-right">$ {{ number_format($total, 2, '.', ',') }}</td>
        </tr>
        </tfoot>
    </table>

@endif