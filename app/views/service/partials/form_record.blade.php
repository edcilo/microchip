@if( p(92) AND $sale->status != 'Cancelado' AND !$sale->trash )

    {{ Form::open(['route'=>['comment.store', $sale->id], 'method'=>'post', 'class'=>'form validate']) }}

    <div class="row">
        {{ Form::textarea('comment', null, ['class'=>'xb-input', 'placeholder'=>'Escribe tu reporte', 'rows'=>3, 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('comment', '<span>:message</span>') }}
        </div>
    </div>

    <div class="col col100 row">

        <div class="flo col50 left">
            <strong>
                {{ Form::label('suggestion', '¿Marcar como sugerencia?') }}
            </strong>
            {{ Form::checkbox('suggestion', 1) }}
        </div>

        <div class="flo col50 right text-right">
            <button type="submit" class="btn-green form_confirm" data-confirm="comment_confirm">
                <i class="fa fa-book"></i>
                Agregar a la bitácora.
            </button>
        </div>

    </div>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Agregar a la bitácora" id="comment_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer guardar el registro en la bitácora del servicio {{ $sale->folio }}?</h3>
        </div>
    </div>

@endif
