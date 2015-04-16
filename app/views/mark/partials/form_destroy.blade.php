@if ( p(44) AND !count($mark->products) )
    <hr/>

    {{ Form::open(['route'=>['mark.destroy', $mark->id], 'method'=>'delete', 'class'=>'form']) }}
    <div class="row text-right">
        <button class="btn-red"><i class="fa fa-times"></i> Eliminar marca</button>
    </div>
    {{ Form::close() }}
@endif