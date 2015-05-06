<table class="table">
    <thead>
    <tr>
        <th>Estado</th>
        <th>Método de pago</th>
        <th>Tipo de pago</th>
        <th>Fecha de pago</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $purchase->payment->status }}</td>
        <td>{{ $purchase->payment->method }}</td>
        <td>
            {{ $purchase->payment->type }}
            @if( is_object($purchase->payment->cheque) )
                :
                <a href="{{ route('cheque.show', [$purchase->payment->cheque->folio, $purchase->payment->cheque->id]) }}">
                    {{ $purchase->payment->cheque->folio }}
                </a>
            @endif
        </td>
        <td>{{ $purchase->payment->payment_date }}</td>
    </tr>
    </tbody>
</table>
