<table class="table">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Estado</th>
        <th>Método de pago</th>
        <th>Tipo de pago</th>
        <th>Fecha de pago</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
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
                        ({{ $payment->cheque->status }})
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
            <td class="text-center">
                @if( is_object($payment->cheque) AND $payment->cheque->status == 'Cancelado' )
                    {{ Form::open(['route' => ['purchasePayment.delete', $payment->id], 'method'=>'delete']) }}
                        <button type="submit" class="btn-red form_confirm" data-confirm="destroy_payment">
                            <i class="fa fa-times"></i>
                        </button>
                    {{ Form::close() }}

                    <div class="confirm-dialog hide" title="Eliminar pago de compra" id="destroy_payment" data-width="400">
                        <div class="mesasge text-center">
                            <p>
                                ¿Estas seguro de queree eliminar el pago de la compra?
                            </p>
                        </div>
                    </div>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
