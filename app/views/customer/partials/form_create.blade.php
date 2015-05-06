<div class="col col100">

    <div class="row flo col20 left">
        {{ Form::label('classification', 'Clasificación:') }} <br/>
        {{ Form::select('classification', $classification_list, null, ['class'=>'xb-input', 'autofocus', 'title'=>'Selecciona un opción valida de la lista', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('classification', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col10 center">
        {{ Form::label('prefix', 'Prefijo:') }} <br/>
        {{ Form::text('prefix', null, ['class'=>'xb-input', 'title'=>'', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('prefix', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col30 center">
        {{ Form::label('name', 'Nombre:') }} <br/>
        {{ Form::text('name', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio', 'data-required'=>'required', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('name', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 center">
        {{ Form::label('legal_concept', 'Concepto legal:') }} <br/>
        {{ Form::select('legal_concept', $concept_list, null, ['class'=>'xb-input', 'title'=>'Selecciona un opción valida de la lista', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('legal_concept', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 right">
        {{ Form::label('rfc', 'R.F.C.:') }} <br/>
        {{ Form::text('rfc', null, ['title'=>'Este campo debe contener 13 caracteres.', 'data-equals'=>'13', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('rfc', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="row flo col25 left">
        {{ Form::label('birthday', 'Fecha de nacimiento:') }} <br/>
        {{ Form::input('date', 'birthday', null, ['title'=>'Este campo debe ser una fecha', 'data-date'=>'date', 'autocomplete'=>'off', 'placeholder'=>"Formato: " . date('Y-m-d')]) }}
        <div class="message-error">
            {{ $errors->first('birthday', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('phone', 'Teléfono:') }} <br/>
        {{ Form::text('phone', null, ['title'=>'Este campo debe ser numerico', 'data-integer-unsigned'=>'integer', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('phone', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('cellphone', 'Célular:') }} <br/>
        {{ Form::text('cellphone', null, ['title'=>'Este campo debe ser numerico', 'data-integer-unsigned'=>'integer', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('cellphone', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 right">
        {{ Form::label('email', 'Correo electrónico:') }} <br/>
        {{ Form::text('email', null, ['class'=>'xb-input', 'title'=>'El contenido de este campo debe ser un correo electronico valido.', 'data-email'=>'email', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('email', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="row flo col25 left">
        {{ Form::label('country', 'País:') }} <br/>
        {{ Form::text('country', 'México', ['title'=>'', 'data-max'=>'255', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('country', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('state', 'Estado:') }} <br/>
        {{ Form::text('state', 'Chiapas', ['title'=>'', 'data-max'=>'255', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('state', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('city', 'Ciudad:') }} <br/>
        {{ Form::text('city', null, ['title'=>'', 'data-max'=>'255', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('city', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 right">
        {{ Form::label('postcode', 'Código postal:') }} <br/>
        {{ Form::text('postcode', null, ['class'=>'sm-input text-right', 'title'=>'Este campo acepta un valor entero de 5 digitos.', 'data-integer-unsigned'=>'integer', 'data-equals'=>'5', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('postcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col30 left">
        {{ Form::label('colony', 'Colonia:') }} <br/>
        {{ Form::text('colony', null, ['class'=>'xb-input', 'title'=>'', 'data-max'=>'255', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('colony', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col40 right">
        {{ Form::label('address', 'Dirección:') }} <br/>
        {{ Form::text('address', null, ['class'=>'xb-input', 'title'=>'', 'data-max'=>'255', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('address', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col30 right">
        {{ Form::label('shipping_address', 'Dirección de envios:') }} <br/>
        {{ Form::textarea('shipping_address', null, ['class'=>'xb-input', 'rows'=>'3']) }}
        <div class="message-error">
            {{ $errors->first('shipping_address', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="row flo col30 left">
        {{ Form::label('card_id', 'Número de monedero:') }}
        {{ Form::text('card_id', null, ['autocomplete'=>'off', 'class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('card_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col30 center">
        {{ Form::label('expiration', 'Días de vigencia (0 para indefinido):') }} <br/>
        {{ Form::text('expiration', null, ['title'=>'Este campo acepta solo valores numericos.', 'data-integer-unsigned'=>'integer', 'class'=>'sm-input', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('expiration', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 center">
        {{ Form::label('credit_limit', 'Límite de crédito:') }} <br/>
        $ {{ Form::text('credit_limit', null, ['title'=>'Este campo acepta solo valores numericos.', 'data-numeric'=>'numeric', 'class'=>'sm-input', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('credit_limit', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 right">
        {{ Form::label('credit_days', 'Días de crédito:') }} <br/>
        {{ Form::text('credit_days', null, ['title'=>'Este campo solo acepta un valor entero.', 'data-integer-unsigned'=>'integer', 'class'=>'sm-input', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('credit_days', '<span>:message</span>') }}
        </div>
    </div>

</div>

@if (!isset($customer))
    <div class="col col100">
        <hr/>

        <div class="row flo col25">

            <label for="customer">¿El usuario es referido?</label>
            <input type="checkbox" value="1" name="customer" id="customer_referred"/>
            {{ $errors->first('customer', '<span>:message</span>') }}

        </div>
    </div>

    <div class="col col100">

        <div class="row flo col33 center">

            <!--
            {{-- Form::hidden('customer_id', null, ['id'=>'customer_id']) --}}
            <label for="customer-search">Recomendado por:</label> <br/>
            <input type="text" name="customer-search" id="customer-search" data-url="{{-- route('customer.search') --}}" autocomplete="off"/>
            <div class="cont-form-search">
                <div class="resultSearch globe-left hide" id="result-search"></div>
            </div>
            -->
            {{ Form::label('customer_id', 'Recomendado por:') }} <br/>
            {{ Form::text('customer_id', null) }}
            <div class="message-error">
                {{ $errors->first('customer_id', '<span>:message</span>') }}
            </div>

        </div>

        <div class="row flo col33 center">
            {{ Form::label('expiration_referrals', 'Vigencia de referido (0 para indefinido):') }} <br/>
            {{ Form::text('expiration_referrals', 0, ['title'=>'Este campo solo acepta valores numericos', 'data-integer-unsigned'=>'integer', 'class'=>'sm-input', 'autocomplete'=>'off']) }}
            <div class="message-error">
                {{ $errors->first('expiration_referrals', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col33 right">

            {{ Form::label('observations', 'Observaciones') }} <br/>
            {{ Form::textarea('observations', null, ['rows'=>'3']) }}
            <div class="message-error">
                {{ $errors->first('observations', '<span>:message</span>') }}
            </div>

        </div>

    </div>
@endif

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Registrar') }}
</div>

{{ Form::close() }}
