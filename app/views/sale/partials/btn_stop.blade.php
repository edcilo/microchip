@if( p(78) OR p(86) )

    <a href="{{ route('sale.stop', [$sale->id]) }}" class="btn-green">
        <i class="fa fa-arrow-right"></i>
        Siguiente
    </a>

@endif