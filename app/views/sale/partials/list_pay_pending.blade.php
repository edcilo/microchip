@if( $sale->status == 'Emitido' )

    <div class="col col100 block description-product">

        <div class="subtitle">Pagos pendientes</div>

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
                <th>
                    <i class="fa fa-gears"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $sale->type }}</td>
                <td>{{ $sale->folio }}</td>
                <td>{{ $sale->customer->name }}</td>
                <td class="text-center">{{ $sale->created_at }}</td>
                <td class="text-right">$ {{ $sale->total_f }}</td>
                <td class="text-right">$ {{ $sale->pay_total_f }}</td>
                <td class="text-right">$ {{ $sale->rest_total_f }}</td>
                <td class="text-center">
                    @include('pay.partials.btn_pay')
                </td>
            </tr>
            </tbody>
        </table>

    </div>

@endif