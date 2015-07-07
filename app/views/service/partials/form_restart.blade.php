@if( p(100) )

    {{ Form::open(['route'=>['service.restart', $sale->id], 'method'=>'post', 'class'=>'form inline']) }}
    <div class="message-error"></div>
    <button class="btn-yellow form_confirm" data-confirm="restart_confirm">
        Marcar servicio en proceso
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Volver servicio a en proceso" id="restart_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer marcar el servicio {{ $sale->folio }} como aún en proceso?</h3>
        </div>
    </div>

@endif
