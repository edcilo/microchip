<table class="table">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
        <th>Pendiente</th>
        <th>Surtido</th>
        <th>
            <i class="fa fa-gears"></i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->pas as $pa)
        @if($pa->status != 'Surtido' AND $pa->productOrder AND !$pa->soft_delete)
            <tr>
                <td class="text-right">{{ $pa->orders_rest }}</td>
                <td>{{ $pa->barcode}}</td>
                <td>{{ $pa->s_description }}</td>
                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                <td class="text-right">$ {{ $pa->total_f }}</td>
                <td class="text-center">
                    <i class="fa fa-check"></i>
                </td>
                <td class="text-center">
                    @include('order.partials.btn_supply')
                </td>
                <td></td>
            </tr>
        @endif
    @endforeach
    @foreach($order->order_products as $movement)
        <tr class="{{ $movement->class_row_series }}">
            <td class="text-right">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode }}</td>
            <td>{{ $movement->product->s_description}}</td>
            <td class="text-right">$ {{ $movement->selling_price_f }}</td>
            <td class="text-right">$ {{ $movement->total_f }}</td>
            <td class="text-center">
                <i class="fa fa-check"></i>
            </td>
            <td class="text-center">
                <i class="fa fa-check"></i>
                <br/>
                @include('order.partials.btn_series')
            </td>
            <td class="text-center">
                @include('order.partials.btn_supply', ['pa' => $movement->pa])
            </td>
            <td></td>
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
        <td><strong>Anticipo sugerido:</strong></td>
        <td>$ {{ $order->advance_f }}</td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td><strong>Saldo:</strong></td>
        <td>$ {{ $order->rest_f }}</td>
    </tr>
    </tfoot>
</table>
