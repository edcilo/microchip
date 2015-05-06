@if( p(87) )

    {{ Form::open(['route'=>['order.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red" type="submit" title="Eliminar venta">
        <i class="fa fa-times"></i>
        Eliminar partida
    </button>
    {{ Form::close() }}

@endif
