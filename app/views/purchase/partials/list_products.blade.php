<table class="table">
    <thead>
    <tr>
        <th><i class="fa fa-barcode"></i></th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Total</th>
        <th>
            <i class="fa fa-gears"></i>
            Opciones
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($purchase->movements as $movement)
        @if(! $movement->warranty)
            <tr class="{{ $movement->class_row_series }}">
                <td>
                    <a href="{{ route('product.show', [$movement->product->slug, $movement->product->id]) }}">
                        {{ $movement->product->barcode }}
                    </a>
                </td>
                <td>
                    {{ $movement->product->s_description }}
                </td>
                <td class="text-right">
                    {{ $movement->quantity }}
                </td>
                <td class="text-right">
                    $ {{ $movement->purchase_price_f }}
                </td>
                <td class="text-right">
                    $ {{ $movement->total_purchase_without_iva_f }}
                </td>

                <td class="text-right">
                    @if ( $movement->product->p_description->have_series )
                        @include('purchase.partials.btn_series')
                    @endif

                    @if( $purchase->status == 'En proceso...' )

                        @include('movement.partials.form_destroy_purchase')

                    @endif
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td>
            <strong>Subtotal:</strong>
        </td>
        <td class="text-right">
            $ {{ $purchase->subtotal_f }}
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>
            <strong>
                I.V.A. (%):
            </strong>
        </td>
        <td class="text-right">
            {{ $purchase->iva }}
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>
            <strong>
                Total:
            </strong>
        </td>
        <td class="text-right">
            $ {{ $purchase->total }}
        </td>
        <td></td>
    </tr>
    <tr>
        <td colspan="3"></td>
        <td>
            <strong>
                Restante:
            </strong>
        </td>
        <td class="text-right">
            $ {{ $purchase->rest}}
        </td>
        <td></td>
    </tr>
    </tfoot>
</table>
