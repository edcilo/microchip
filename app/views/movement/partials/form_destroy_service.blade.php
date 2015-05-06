@if( p(95) )

    {{ Form::open(['route'=>['pas.destroy', $pa->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red" title="Borrar producto">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

    @endif
