@if(count($cancellations))

    <table class="table">
        <thead>
        <tr>
            <th>Tipo</th>
            <th>Documento</th>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Saldo</th>
            <th>Devolución</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cancellations as $cancellation)
            <tr>
                <td>{{ $cancellation->type }}</td>
                <td>{{ $cancellation->classification }}</td>
                <td>{{ $cancellation->folio }}</td>
                <td>{{ $cancellation->customer->name }}</td>
                <td class="text-center">{{ $cancellation->created_at }}</td>
                <td class="text-right">$ {{ $cancellation->total_f }}</td>
                <td class="text-right">$ {{ $cancellation->user_total_pay_f }}</td>
                <td class="text-center">
                    @include('pay.partials.btn_repayment')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else

    <p class="title-clear">No hay cancelaciones pendientes</p>

@endif
