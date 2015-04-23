@if(count($sales))

    <table class="table">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Abono</th>
            <th>Saldo</th>
            <th>Pagar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->type }}</td>
                <td>{{ $sale->folio }}</td>
                <td>{{ $sale->customer->name }}</td>
                <td class="text-center">{{ $sale->created_at }}</td>
                <td class="text-right">
                    <nobr>
                        $ {{ $sale->total_f }}
                        @if( $sale->new_price > 0 )
                            + $ {{ $sale->difference_iva }}
                            = $ {{ $sale->pv_di_f }}
                        @endif
                    </nobr>
                </td>
                <td class="text-right">
                    <nobr>$ {{ $sale->user_total_pay_f }}</nobr>
                </td>
                <td class="text-right">$ {{ $sale->user_rest_total_f }}</td>
                <td class="text-center">
                    @if( $sale->getUserRestTotalAttribute() != 0 )

                        @include('pay.partials.btn_pay')

                    @else

                        @include('pay.partials.btn_free')

                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $sales->links() }}

@else

    <p class="title-clear">No hay pagos pendientes</p>

@endif