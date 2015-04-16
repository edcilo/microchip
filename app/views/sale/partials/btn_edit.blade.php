@if( p(78) AND ( $sale->status != 'Cancelado' ))

    <a href="{{ route('sale.edit', [$sale->id]) }}" class="btn-yellow">
        <i class="fa fa-pencil"></i>
        Modificar venta
    </a>

    @endif