<table class="table">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @if(count($order->pas))
        <tr>
            <td colspan="6"><strong>Pendientes</strong></td>
        </tr>
    @endif
    @foreach($order->pas as $pa)
        @if($pa->status != 'Surtido' AND $pa->productOrder AND !$pa->soft_delete)
            <tr>
                <td class="text-right">{{ $pa->orders_rest }}</td>
                <td>{{ $pa->barcode}}</td>
                <td>{{ $pa->s_description }}</td>
                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                <td class="text-right">$ {{ $pa->total_f }}</td>
                <td class="text-right">
                    @include('order.partials.btn_supply')
                </td>
            </tr>
        @endif
    @endforeach
    @if(count($order->orderProducts))
        <tr>
            <td colspan="6"><strong>Surtidos</strong></td>
        </tr>
    @endif
    @foreach($order->order_products as $movement)
        <tr class="{{ $movement->class_row_series }}">
            <td class="text-right">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode }}</td>
            <td>{{ $movement->product->s_description}}</td>
            <td class="text-right">$ {{ $movement->selling_price_f }}</td>
            <td class="text-right">$ {{ $movement->total_f }}</td>
            <td class="text-right">
                @include('order.partials.btn_series')

                @include('order.partials.btn_supply')
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Total (I.V.A. incluido):</strong></td>
        <td>$ {{ $order->total_order_f }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Anticipo:</strong></td>
        <td>$ {{ $order->advance_f }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Saldo:</strong></td>
        <td>$ {{ $order->rest_f }}</td>
    </tr>
    </tfoot>
</table>