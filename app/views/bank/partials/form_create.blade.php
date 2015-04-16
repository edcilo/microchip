<div class="flo col50 left">

    <fieldset>
        <legend>Banco</legend>

        <div class="row">
            {{ Form::label('name', 'Nombre del banco: ', ['class'=>'label50']) }}
            {{ Form::text('name', null, ['autofocus', 'title'=>'Este campo es obligatorio', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('name', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('branch', 'Sucursal: ', ['class'=>'label50']) }}
            {{ Form::text('branch', null, ['title'=>'Este campo es obligatorio', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('branch', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('number_account', 'Número de cuenta: ', ['class'=>'label50']) }}
            {{ Form::text('number_account', null, ['title'=>'Este campo es obligatorio y debe ser de tipo entero con un tamaño de 11 digitos.', 'data-required'=>'required', 'data-integer'=>'integer', 'data-equals'=>'11']) }}
            <div class="message-error">
                {{ $errors->first('number_account', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('clabe', 'CLABE: ', ['class'=>'label50']) }}
            {{ Form::text('clabe', null, ['title'=>'Este campo es obligatorio y debe ser de tipo entero con un tamaño de 18 digitos.', 'data-required'=>'required', 'data-integer'=>'integer', 'data-equals'=>'18']) }}
            <div class="message-error">
                {{ $errors->first('clabe', '<span>:message</span>') }}
            </div>
        </div>

    </fieldset>


    <fieldset>
        <legend>Terminal</legend>

        <div class="row">
            {{ Form::label('terminal', '¿Cuenta con terminal?') }}
            {{ Form::checkbox('terminal', 1, null, []) }} Si.
        </div>

        <div class="row">
            {{ Form::label('commission_debit', 'Cargo por tarjeta de débito: ', ['class'=>'label50']) }}
            {{ Form::text('commission_debit', null, ['class'=>'text-right', 'title'=>'Este campo debe ser de tipo numerico.', 'data-numeric'=>'numeric']) }} %
            <div class="message-error">
                {{ $errors->first('commission_debit', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('commission_credit', 'Cargo por tarjeta de crédito: ', ['class'=>'label50']) }}
            {{ Form::text('commission_credit', null, ['class'=>'text-right', 'title'=>'Este campo debe ser de tipo numerico.', 'data-numeric'=>'numeric']) }} %
            <div class="message-error">
                {{ $errors->first('commission_credit', '<span>:message</span>') }}
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend>Contacto</legend>

        <div class="row">
            {{ Form::label('phone', 'Teléfono: ', ['class'=>'label50']) }}
            {{ Form::text('phone', null, ['title'=>'Este campo debe ser de tipo entero y acepta al menos 6 digitos', 'data-integer'=>'integer', 'data-min'=>'6']) }}
            <div class="message-error">
                {{ $errors->first('phone', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('executive_name', 'Nombre de ejecutivo: ', ['class'=>'label50']) }}
            {{ Form::text('executive_name', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('executive_name', '<span>:message</span>') }}
            </div>
        </div>

    </fieldset>

</div>

<div class="flo col50 right">

    <fieldset>
    <legend>Ubicación</legend>

        <div class="row">
            {{ Form::label('country', 'País: ', ['class'=>'label50']) }}
            {{ Form::text('country', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('country', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('state', 'Estado: ', ['class'=>'label50']) }}
            {{ Form::text('state', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('state', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('city', 'Ciudad: ', ['class'=>'label50']) }}
            {{ Form::text('city', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('city', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('postcode', 'Código Postal: ', ['class'=>'label50']) }}
            {{ Form::text('postcode', null, ['title'=>'Este campo debe ser de valor entero y tener 5 digitos', 'data-integer'=>'integer', 'data-equals'=>'5']) }}
            <div class="message-error">
                {{ $errors->first('postcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('colony', 'Colonia: ', ['class'=>'label50']) }}
            {{ Form::text('colony', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('colony', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('address', 'Dirección: ', ['class'=>'label50']) }}
            {{ Form::text('address', null, ['title'=>'']) }}
            <div class="message-error">
                {{ $errors->first('address', '<span>:message</span>') }}
            </div>
        </div>

    </fieldset>

</div>

<div class="col col100 text-center">
    {{ Form::submit('Guardar') }}
</div>

{{ Form::close() }}