@if( p(87) AND $sale->status == 'Pendiente')

    <a class="btn-red btn-delete" href="#" data-id="{{ $order->id }}" data-name="{{ $order->folio }}" title="Eliminar pedido">
        <i class="fa fa-times"></i>
    </a>

@endif
