<table class="table">
    <thead>
    <tr>
        <th><i class="fa fa-barcode"></i></th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>
            <a href="{{ route('product.show', [$warranty->movementIn->product->slug, $warranty->movementIn->product->id]) }}">
                {{ $warranty->movementIn->product->barcode }}
            </a>
        </td>
        <td>
            {{ $warranty->movementIn->product->s_description }}
        </td>
        <td class="text-right">
            {{ $warranty->movementIn->quantity }}
        </td>
        <td class="text-right">
            $ {{ $warranty->movementIn->getPurchasePriceWithIvaFAttribute() }}
        </td>
    </tr>
    </tbody>
</table>