<div class="col col100 block description-product">

    <h3 class="subtitle">Precios</h3>

    <table class="table">
        <thead>
        <tr>
            @if ( is_object($product->p_description) )
                <th>Último precio de compra</th>
                <th>Utilidad</th>
            @endif
            <th>Precio al público (Sin I.V.A.)</th>
            <th>I.V.A.</th>
            <th>Precio al público (I.V.A. incluido)</th>
        </tr>
        </thead>
        <tbody class="text-right">
        <tr>
            @if ( is_object($product->p_description) )
                <td>$ {{ $product->p_description->purchase_price }}</td>
                <td>{{ $product->utility_1 }} %</td>
            @endif
            <td>$ {{ $product->price_1 }}</td>
            <td>16 %</td>
            <td>$ {{ $product->price_iva_1 }}</td>
        </tr>
        <tr>
            @if ( is_object($product->p_description) )
                <td></td>
                <td>{{ $product->utility_2 }} %</td>
            @endif
            <td>$ {{ $product->price_2 }}</td>
            <td></td>
            <td>$ {{ $product->price_iva_2 }}</td>
        </tr>
        <tr>
            @if ( is_object($product->p_description) )
                <td></td>
                <td>{{ $product->utility_3 }} %</td>
            @endif
            <td>$ {{ $product->price_3 }}</td>
            <td></td>
            <td>$ {{ $product->price_iva_3 }}</td>
        </tr>
        <tr>
            @if ( is_object($product->p_description) )
                <td></td>
                <td>{{ $product->utility_4 }} %</td>
            @endif
            <td>$ {{ $product->price_4 }}</td>
            <td></td>
            <td>$ {{ $product->price_iva_4 }}</td>
        </tr>
        <tr>
            @if ( is_object($product->p_description) )
                <td></td>
                <td>{{ $product->utility_5 }} %</td>
            @endif
            <td>$ {{ $product->price_5 }}</td>
            <td></td>
            <td>$ {{ $product->price_iva_5 }}</td>
        </tr>
        </tbody>
    </table>

</div>
