@if( p(86) AND $order->status != 'Cancelado')

    <a href="{{ route('order.edit', [$order->id]) }}" class="btn-yellow">
        <i class="fa fa-pencil"></i>
        Modificar pedido
    </a>

@endif
