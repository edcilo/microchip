@if(count($services))

    <table class="table">
        <thead>
        <tr>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Abono</th>
            <th>Saldo</th>
            <th>Abonar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $sale)
            @if( $sale->getTotalPrice() != 0 )
                <tr>
                    <td>{{ $sale->folio }}</td>
                    <td>{{ $sale->customer->name }}</td>
                    <td class="text-center">{{ $sale->created_at }}</td>
                    <td class="text-right">$ {{ $sale->total_price_f }}</td>
                    <td class="text-right">$ {{ $sale->user_total_pay_f }}</td>
                    <td class="text-right">$ {{ $sale->user_rest_total_f }}</td>
                    <td class="text-center">
                        @include('pay.partials.btn_pay')
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>


    {{ $services->links() }}

@else

    <p class="title-clear">No hay servicios pendientes</p>

@endif
