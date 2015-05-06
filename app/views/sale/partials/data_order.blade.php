<div class="col col100">
    <ul>
        <li>
            <strong>Cliente que realizó el pedido:</strong>
            {{ $sale->customerOrder->name }}
        </li>
        <li>
            <strong>Anticipo:</strong>
            $ {{ $sale->advance }}
        </li>
    </ul>
</div>

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
    @foreach($sale->pas as $pa)
        @if($pa->productOrder AND !$pa->soft_delete)
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
</table>
