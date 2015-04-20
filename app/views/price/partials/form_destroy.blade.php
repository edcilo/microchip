@if( p(108))
    {{ Form::open(['route'=>['price.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red" type="submit" title="Eliminar cotización">
        <i class="fa fa-times"></i>
        Borrar cotización
    </button>
    {{ Form::close() }}
@endif