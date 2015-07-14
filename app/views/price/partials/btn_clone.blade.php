@if( p(109) )

    <a href="{{ route('price.clone', [$sale->id]) }}" class="btn-yellow" target="_blank">
        <i class="fa fa-copy"></i>
        Clonar cotización
    </a>

    @else

    &nbsp;

    @endif
