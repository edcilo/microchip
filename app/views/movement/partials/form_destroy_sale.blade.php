@if( p(78) )

    {{ Form::open(['route'=>['movement.destroy', $movement->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red" title="Borrar producto">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

@endif