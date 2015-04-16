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
    @foreach($sale->movements as $movement)
        <tr>
            <td class="text-right">{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode}}</td>
            <td>{{ $movement->product->s_description }}</td>
            <td class="text-right">$ {{ $movement->selling_price_f }}</td>
            <td class="text-right">$ {{ $movement->total_f }}</td>
        </tr>
        @foreach( $movement->seriesOut as $series )
            <tr>
                <td></td>
                <td><strong>S/N</strong> {{ $series->ns }}</td>
                <td colspan="3"></td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
    <tfoot class="text-right">
    <tr>
        <td colspan="3"></td>
        <td><strong>Total (I.V.A. incluido):</strong></td>
        <td>$ {{ $sale->total_f }}</td>
    </tr>
    @if($sale->advance > 0)
        <tr>
            <td colspan="3"></td>
            <td><strong>Anticipo:</strong></td>
            <td>$ {{ $sale->advance_f }}</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td><strong>Saldo:</strong></td>
            <td>$ {{ $sale->rest_f }}</td>
        </tr>
    @endif
    </tfoot>
</table>