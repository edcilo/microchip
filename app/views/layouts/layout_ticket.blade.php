<p>{{ $company->name }}</p>

<ul class="unlist">
    <li>{{ $company->owner }}</li>
    <li>{{ $company->rfc }}</li>
    <li>{{ $company->address }}, {{ $company->colony }}</li>
    <li>{{ $company->city }}, {{ $company->state }}</li>
    <li>Tel. {{ $company->phone_1 }} y {{ $company->phone_2 }}</li>
    <li>{{ $company->web }}</li>
</ul>

<table>
    <tr>
        <td>Ticket No.:</td>
        <td class="text-right">{{ $sale->folio }}</td>
    </tr>
    <tr>
        <td>Fecha:</td>
        <td class="text-right">{{ date( 'd/M/Y h:m a', time($sale->created_at)) }}</td>
    </tr>
    <tr>
        <td>Vendedor:</td>
        <td class="text-right">{{ $sale->user_id }}</td>
    </tr>
    <tr>
        <td>No. Cte:</td>
        <td class="text-right">{{ $sale->customer_id }}</td>
    </tr>
</table>


<table>
    <tbody>
    @foreach($sale->movements as $movement)
        <tr>
            <td>{{ $movement->quantity }}</td>
            <td>{{ $movement->product->barcode }}</td>
            <td>{{ $movement->product->s_description }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="text-right">$ {{ $movement->selling_price_f }}</td>
            <td class="text-right">$ {{ $movement->total_f }}</td>
        </tr>
        @if ( count( $movement->seriesOut ) > 0 )
            <tr>
                <td></td>
                <td><strong>S/N</strong>
                    @foreach( $movement->seriesOut as $series )
                        {{ $series->ns }};
                    @endforeach
                </td>
                <td></td>
            </tr>
        @endif
    @endforeach
    </tbody>
    <tfoot>
    <tr class="text-right">
        <td></td>
        <td>Total:</td>
        <td>$ {{ $sale->total_f }}</td>
    </tr>
    <tr class="text-center">
        <td colspan="3">En letras: {{ $sale->total_text }}</td>
    </tr>
    </tfoot>
</table>


<div class="barcode">
    {{ DNS1D::getBarcodeHTML($sale->folio, "C128", 1, 20) }}
</div>
