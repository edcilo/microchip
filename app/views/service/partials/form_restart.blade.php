@if( p(100) )

    {{ Form::open(['route'=>['service.restart', $sale->id], 'method'=>'post', 'class'=>'form inline']) }}
    <div class="message-error"></div>
    <button class="btn-yellow">
        Marcar servicio en proceso
    </button>
    {{ Form::close() }}

    @endif