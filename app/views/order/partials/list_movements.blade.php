<table class="table">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Precio unitario</th>
        <th>Total</th>
        <th><i class="fa fa-gears"></i></th>
    </tr>
    </thead>
    <tbody>
    @foreach($sale->pas as $movement)
        @if($movement->status != 'Surtido' AND $movement->productOrder AND !$movement->soft_delete)
            <tr>
                <td>{{ $movement->barcode }}</td>
                <td>{{ $movement->s_description }}</td>
                <td class="text-right">{{ $movement->quantity }}</td>
                <td class="text-right">$ {{ $movement->selling_price_f }}</td>
                <td class="text-right">$ {{ $movement->total_f }}</td>
                <td class="text-right">
                    @include('movement.partials.form_destroy_order')
                </td>
            </tr>
        @endif
    @endforeach()
    </tbody>
    <tfoot>
    <tr>
        <td colspan="3"></td>
        <td class="text-right">Total:</td>
        <td class="text-right">$ {{ $sale->total_order_f }}</td>
        <td></td>
    </tr>
    </tfoot>
</table>
