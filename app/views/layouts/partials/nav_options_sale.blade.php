<div class="col col100 text-center">

    @if( p(77) )
        <div class="flo col25 left text-center">
            <a href="{{ route('sale.create') }}" class="btn-green">
                <i class="fa fa-file-text-o"></i>
                Nueva venta
            </a>
        </div>
    @endif

    @if( p(85) )
        <div class="flo col25 center text-center">
            <a href="{{ route('order.create') }}" class="btn-blue">
                <i class="fa fa-file-text-o"></i>
                Nuevo pedido
            </a>
        </div>
    @endif

    @if( p(94) )
        <div class="flo col25 right text-center">
            <a href="{{ route('service.create') }}" class="btn-blue">
                <i class="fa fa-file-text-o"></i>
                Nuevo servicio
            </a>
        </div>
    @endif

    @if( p(106) )
        <div class="flo col25 center text-center">
            <a href="{{ route('price.create') }}" class="btn-red">
                <i class="fa fa-file-text-o"></i>
                Nueva cotización
            </a>
        </div>
    @endif

</div>
