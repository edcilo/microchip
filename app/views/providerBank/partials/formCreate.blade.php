    {{ Form::hidden('provider_id', $provider->id) }}

    <div class="flo col50 row left">
        <div class="flo col30 left">
            <strong>{{ Form::label('bank', 'Nombre del banco:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('bank', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio', 'data-required'=>'required', 'data-max'=>'120', 'autofocus']) }}
            <div class="message-error">
                {{ $errors->first('bank', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row right">
        <div class="flo col30 left">
            <strong>{{ Form::label('account', 'Número de cuenta:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('account', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio y debe ser de tipo entero con un tamaño de 11 digitos.', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'data-equals'=>'11']) }}
            <div class="message-error">
                {{ $errors->first('account', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row left">
        <div class="flo col30 left">
            <strong>{{ Form::label('clabe', 'CLABE: ') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('clabe', null, ['class'=>'xb-input', 'title'=>'Este campo debe ser de tipo entero con un tamaño de 18 digitos.', 'data-integer-unsigned'=>'integer', 'data-equals'=>'18']) }}
            <div class="message-error">
                {{ $errors->first('clabe', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row right">
        <div class="flo col30 left">
            <strong>{{ Form::label('plaza', 'Sucursal: ') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('plaza', null, ['class'=>'xb-input', 'title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('plaza', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="col col100 row">

        <div class="flo col50 text-center">
            <button type="submit" class="btn-green">
                <i class="fa fa-save"></i> Guardar
            </button>
        </div>

        <div class="flo col50 text-center">
            <a href="{{ route('provider.show', [$provider->slug, $provider->id]) }}" class="btn-red" title="Cancelar">
                Cancelar
            </a>
        </div>

    </div>

{{ Form::close() }}
