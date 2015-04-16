@if( p(61) AND $purchase->progress_4 )

    {{ Form::open(['route'=>['movement.destroy', $movement->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

@endif