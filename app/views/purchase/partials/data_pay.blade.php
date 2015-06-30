<table class="table">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Estado</th>
        <th>Método de pago</th>
        <th>Tipo de pago</th>
        <th>Fecha de pago</th>
    </tr>
    </thead>
    <tbody>
    @foreach($purchase->payments as $payment)
        <tr>
            <td>$ {{ $payment->value }}</td>
            <td>{{ $payment->status }}</td>
            <td>{{ $payment->method }}</td>
            <td>
                {{ $payment->type }}
                @if( is_object($payment->cheque) )
                    :
                    <a href="{{ route('cheque.show', [$payment->cheque->folio, $payment->cheque->id]) }}">
                        {{ $payment->cheque->folio }}
                    </a>
                @elseif( is_object($payment->coupon) )
                    :
                    <a href="{{ route('coupon.purchase.show', [$payment->coupon->id]) }}">
                        {{ $payment->coupon->folio }}
                    </a>
                @endif
                @if (!empty($payment->description))
                    : {{ $payment->description }}
                @endif
            </td>
            <td class="text-center">{{ $payment->payment_date_f }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
