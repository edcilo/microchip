@if( p(61) )

    <a class="btn-green" href="{{ route('purchase.stop', [$purchase->id]) }}">
        <i class="fa fa-ban"></i>
        Terminar captura de productos
    </a>

@endif
