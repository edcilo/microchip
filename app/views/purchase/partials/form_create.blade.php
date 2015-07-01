<div class="col col100">

    <div class="row flo col33 left">
        {{ Form::label('provider_id', 'Proveedor: ') }} <br/>
        {{ Form::select('provider_id', $provider_list, null, ['title'=>'Seleccione un campo valido de la lista.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('provider_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col33 center">
        {{ Form::label('folio', 'Folio: ') }} <br/>
        {{ Form::text('folio', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('folio', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col33 right">
        {{ Form::label('date', 'Fecha del documento: ') }} <br/>
        {{ Form::text('date', date('Y-m-d'), ['placeholder'=>'AAAA-MM-DD', 'title'=>'Este campo es obligatorio y debe ser una fecha con el formato "AAAA-MM-DD".', 'data-required'=>'required', 'data-date'=>'date', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('date', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <div class="row flo col33 left">
        {{ Form::label('reception_date', 'Fecha de recepción: ') }} <br/>
        {{ Form::text('reception_date', date('Y-m-d'), ['placeholder'=>'AAAA-MM-DD', 'title'=>'Este campo es obligatorio y debe ser una fecha con el formato "AAAA-MM-DD".', 'data-required'=>'required', 'data-date'=>'date', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('reception_date', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col33 center">
        {{ Form::label('iva', 'I.V.A (%): ') }} <br/>
        {{ Form::text('iva', $iva, ['title'=>'Este campo es obligatorio y debe ser un valor numerico".', 'data-required'=>'required', 'data-numeric'=>'numeric', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('iva', '<span>:message</span>') }}
        </div>
    </div>
</div>

<hr/>

<div class="col col100">
    <div class="flo col50 row left text-center">
        {{ Form::submit('Continuar') }}
    </div>

    <div class="flo col50 row right text-center">
        {{ Form::reset('Reiniciar formulario') }}
    </div>
</div>

{{ Form::close() }}
