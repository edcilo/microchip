@if( p(97) )

    {{ Form::model($sale, ['route'=>['service.edit.delivery.date', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

    <div class="flo col33 left">

        {{ Form::label('delivery_date', 'Fecha de entrega:') }}
        {{ Form::input('date', 'delivery_date', null, ['class'=>'', 'data-required'=>'required']) }}

        <div class="message-error">
            {{ $errors->first('delivery_date', '<span>:message</span>') }}
        </div>

    </div>

    <div class="flo col33 center">

        {{ Form::label('delivery_time', 'Hora de entrega:') }}
        {{ Form::text('delivery_time', null, ['class'=>'', 'data-required'=>'required']) }} hrs.

        <div class="message-error">
            {{ $errors->first('delivery_time', '<span>:message</span>') }}
        </div>

    </div>

    <div class="flo col33 right text-right">
        <button type="submit" class="btn-green form_confirm" data-confirm="delivery_confirm">
            <i class="fa fa-save"></i>
            Guardar
        </button>
    </div>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Posponer fecha de entrega" id="delivery_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer posponer la fecha de entraga del servicio {{ $sale->folio }}?</h3>
        </div>
    </div>

@endif
