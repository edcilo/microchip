<table class="table">
    <thead>
    <tr>
        <th></th>
        <th>Utilidad</th>
        <th>Precio</th>
        <th>Precio I.V.A. (<span id="iva">{{ $iva }}</span> %)</th>
        <th>Precio de oferta</th>
    </tr>
    </thead>
    <tbody class="text-center">
    <tr>
        <th>(1)</th>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_1 }}">
            %
        </td>
        <td>
            $
            <input type="text" class="sm-input text-right" disabled value="{{ $product->price_1 }}">
        </td>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva1Attribute($iva) }}">
        </td>
        <td>
            @if ($product->offer == 1) <i class="fa fa-check"></i> @endif
        </td>
    </tr>
    <tr>
        <th>(2)</th>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_2 }}">
            %
        </td>
        <td>
            $
            <input type="text" class="sm-input text-right" disabled value="{{ $product->price_2 }}">
        </td>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva2Attribute($iva) }}">
        </td>
        <td>
            @if ($product->offer == 2) <i class="fa fa-check"></i> @endif
        </td>
    </tr>
    <tr>
        <th>(3)</th>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_3 }}">
            %
        </td>
        <td>
            $
            <input type="text" class="sm-input text-right" disabled value="{{ $product->price_3 }}">
        </td>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva3Attribute($iva) }}">
        </td>
        <td>
            @if ($product->offer == 3) <i class="fa fa-check"></i> @endif
        </td>
    </tr>
    <tr>
        <th>(4)</th>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_4 }}">
            %
        </td>
        <td>
            $
            <input type="text" class="sm-input text-right" disabled value="{{ $product->price_4 }}">
        </td>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva4Attribute($iva) }}">
        </td>
        <td>
            @if ($product->offer == 4) <i class="fa fa-check"></i> @endif
        </td>
    </tr>
    <tr>
        <th>(5)</th>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_5 }}">
            %
        </td>
        <td>
            $
            <input type="text" class="sm-input text-right" disabled value="{{ $product->price_5 }}">
        </td>
        <td>
            <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva5Attribute($iva) }}">
        </td>
        <td>
            @if ($product->offer == 5) <i class="fa fa-check"></i> @endif
        </td>
    </tr>
    </tbody>
</table>