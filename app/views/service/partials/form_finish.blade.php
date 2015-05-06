@if( p(98) )

    {{ Form::open(['route'=>['service.finish', $sale->id], 'method'=>'post', 'class'=>'form']) }}
    <button class="btn-green">
        Marcar servicio como terminado
    </button>
    {{ Form::close() }}

    @endif
