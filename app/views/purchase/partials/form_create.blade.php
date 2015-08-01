<div class="col col100">

    <div class="row flo col33 left">
        {{ Form::label('provider', 'Proveedor: ') }}<br/>
        <div class="col col100">
            <div class="flo col85">
                {{ Form::text('provider', isset($purchase) ? $purchase->provider->name : null, ['class'=>'xb-input', 'autofocus', 'autocomplete'=>'off', 'data-url'=>route('provider.search')]) }}
                <div class="cont-form-search">
                    <div class="resultSearch globe-center hide" id="provider_search_and_add"></div>
                </div>
            </div>
            <div class="flo col15">
                @include('provider.partials.btn_create_blank')
            </div>
        </div>
        <div class="message-error">
            {{ $errors->first('provider', '<span>:message</span>') }}
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
        {{ Form::text('iva', isset($iva) ? $iva : null, ['title'=>'Este campo es obligatorio y debe ser un valor numerico".', 'data-required'=>'required', 'data-numeric'=>'numeric', 'autocomplete'=>'off']) }}
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
