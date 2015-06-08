<div class="col col100 block description-product edc-hide-show">

    <div class="subtitle">
        Cobros en efectivo
        <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
    </div>

    <div class="table edc-hide-show-element hide">

        <table class="table">
            <thead>
            <tr>
                <th>Folio</th>
                <th>Documento</th>
                <th>Total</th>
                <th>Cobrado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pays as $pay)
                @if($pay->sale AND $pay->method == 'Efectivo' AND $pay->amount > 0)
                    <tr>
                        <td>
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
                        </td>
                        <td>{{ $pay->sale->classification }}</td>
                        <td class="text-right">
                            $
                            @if ($pay->sale->classification == 'Venta')
                                {{ $pay->sale->total_f }}
                            @elseif($pay->sale->classification == 'Pedido')
                                {{ $pay->sale->total_order_f }}
                            @elseif($pay->sale->classification == 'Servicio')
                                {{ $pay->sale->total_price_f }}
                            @endif
                        </td>
                        <td class="text-right">
                            ${{ number_format($pay->amount - $pay->change, 2, '.', ',') }}
                        </td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>

    </div>

</div>