@if( p(98) )

    {{ Form::open(['route'=>['service.finish', $sale->id], 'method'=>'post', 'class'=>'form']) }}
    <button class="btn-green form_confirm" data-confirm="finish_confirm">
        Marcar servicio como terminado
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Marcar servicio como terminado" id="finish_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de que el servicio {{ $sale->folio }} esta terminado?</h3>
        </div>
    </div>

@endif
