@if( p(78) OR p(86) OR p(95) OR p(107) )

    <a href="{{ route('sale.start', [$sale->id]) }}" class="btn-blue">
        <i class="fa fa-cart-plus"></i>
        Modificar
    </a>

@endif