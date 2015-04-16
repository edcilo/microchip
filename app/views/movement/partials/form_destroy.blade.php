@if( p(53) )
    {{ Form::open(['route'=>['movement.destroy.simple', $movement->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button class="btn-red">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}
@endif