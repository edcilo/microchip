@if(count($orders))

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
        @foreach($orders as $sale)
            <tr>
                <td>{{ $sale->folio }}</td>
                <td>{{ $sale->customer->name }}</td>
                <td class="text-center">{{ $sale->created_at }}</td>
                <td class="text-right">$ {{ $sale->total_order_f }}</td>
                <td class="text-right">$ {{ $sale->pay_total_f }}</td>
                <td class="text-right">$ {{ $sale->rest_total_f }}</td>
                <td class="text-center">
                    @include('pay.partials.btn_pay')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


    {{ $orders->links() }}

@else

    <p class="title-clear">No hay pedidos pendientes</p>

@endif