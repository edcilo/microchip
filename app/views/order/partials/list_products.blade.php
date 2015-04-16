<table class="table">
    <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cost. unit.</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->pas as $pa)
        @if($pa->status != 'Surtido' AND $pa->productOrder AND !$pa->soft_delete)
        <tr>
            <td class="text-right">{{ $pa->quantity }}</td>
            <td>{{ $pa->barcode}}</td>
            <td>{{ $pa->s_description }}</td>
            <td class="text-right">$ {{ $pa->selling_price_f }}</td>
            <td class="text-right">$ {{ $pa->total_f }}</td>
        </tr>
        @endif
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