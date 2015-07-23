@if($sale->status != 'Cancelado' AND $sale->trash)

    <div class="col col100 block description-product edc-hide-show">
        <div class="subtitle">
            Recuperar servicio
            <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
        </div>

        <div class="edc-hide-show-element hide">

            {{ Form::open(['route' => ['service.restore', $sale->id], 'class'=>'form validate']) }}

            <div class="row">
                {{ Form::textarea('comment', null, [
                    'placeholder'=>'Razón por la que se recupera el servicio...',
                    'class' => 'xb-input',
                    'rows' => 3,
                    'data-required' => 'required'
                ]) }}
                <div class="message-error">
                    {{ $errors->first('comment', '<span>:message</span>') }}
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-green form_confirm" data-confirm="trash_confirm" title="Descartar servicio">
                    <i class="fa fa-recycle"></i>
                    Recuperar servicio
                </button>
            </div>

            {{ Form::close() }}

            <div class="confirm-dialog hide" title="Descartar servicio" id="trash_confirm" data-width="400">
                <div class="mesasge text-center">
                    <h3>¿Estas seguro de querer recuperar el servicio {{ $sale->folio }}?</h3>
                </div>
            </div>

        </div>
    </div>

@endif