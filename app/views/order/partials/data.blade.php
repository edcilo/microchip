<div class="col col100">
    <div class="flo col50">
        <ul>
            <li>
                <strong>C.T.</strong>
                {{ $order->customer->id }}
            </li>
            <li>
                <strong>Razón Social:</strong>
                <a href="{{ route('customer.show', [$order->customer->slug, $order->customer->id]) }}">
                    {{ $order->customer->prefix }}
                    {{ $order->customer->name }}
                </a>
            </li>
            <li>
                <strong>Dirección:</strong>
                {{ $order->customer->address }}, {{ $order->customer->colony }}, C.P. {{ $order->customer->postal_code }}; {{ $order->customer->city }}, {{ $order->customer->state }}
            </li>
            <li>
                <strong>Telefono(s):</strong>
                {{ $order->customer->phone }} - {{ $order->customer->cellphone }}
            </li>
            <li>
                <strong>E-mail:</strong>
                {{ $order->customer->email }}
            </li>
        </ul>
    </div>

    <div class="flo col50 text-right">
        <ul>
            <li>
                <strong>Folio:</strong>
                {{ $order->folio }}
            </li>
            <li>
                <strong>Fecha:</strong>
                {{ date( 'd/M/Y', time($order->created_at)) }}
            </li>
            <li>
                <strong>Vend.</strong>
                {{ $order->user->id }}
            </li>
            <li>
                <strong>Nombre:</strong>
                {{ $order->user->profile->name }} {{ $order->user->profile->f_last_name }} {{ $order->user->profile->s_last_name }}
            </li>
            <li>
                <strong>Fecha de entrega:</strong>
                {{ $order->delivery_date }}
            </li>
            <li>
                <strong>Dirección de envio:</strong>
                {{ $order->shipping_address }}
            </li>
        </ul>
    </div>
</div>
