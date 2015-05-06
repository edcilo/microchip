@if( p(81) )

    {{ Form::open(['route'=>['sale.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red" type="submit" title="Eliminar venta">
        <i class="fa fa-times"></i>
        Eliminar partida
    </button>
    {{ Form::close() }}

@endif
