    {{ Form::hidden('provider_id', $provider->id) }}

    <div class="flo col50 row text-right left">
        <div class="flo col30 left">
            <strong>{{ Form::label('name', 'Nombre:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('name', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio', 'data-required'=>'required', 'data-max'=>'120', 'autofocus']) }}
            <div class="message-error">
                {{ $errors->first('name', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row text-right right">
        <div class="flo col30 left">
            <strong>{{ Form::label('last_name', 'Apellido:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('last_name', null, ['class'=>'xb-input', 'data-max'=>'120']) }}
            <div class="message-error">
                {{ $errors->first('last_name', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row text-right left">
        <div class="flo col30 left">
            <strong>{{ Form::label('job', 'Puesto:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('job', null, ['class'=>'xb-input', 'data-max'=>'120']) }}
            <div class="message-error">
                {{ $errors->first('job', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 row text-right right">
        <div class="flo col30 left">
            <strong>{{ Form::label('phone', 'Teléfono:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('phone', null, ['class'=>'xb-input', 'data-integer-unsigned'=>'integer', 'data-max'=>'120']) }}
            <div class="message-error">
                {{ $errors->first('phone', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="col col100 row text-right">
        <div class="flo col30 left">
                <strong>{{ Form::label('email', 'Correo electrónico:') }}</strong>
        </div>
        <div class="flo col70 right">
            {{ Form::text('email', null, ['class'=>'xb-input', 'data-email'=>'email', 'data-max'=>'120']) }}
            <div class="message-error">
                {{ $errors->first('email', '<span>:message</span>') }}
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
