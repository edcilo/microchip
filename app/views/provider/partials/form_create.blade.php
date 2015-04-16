<fieldset>
    <legend>Datos del proveedor</legend>

    <div class="col col100">
        <div class="flo col50">
            <div class="row">
                {{ Form::label('name', 'Nombre: ', ['class'=>'label50']) }}
                {{ Form::text('name', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
                <div class="message-error">
                    {{ $errors->first('name', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('rfc', 'R.F.C: ', ['class'=>'label50']) }}
                {{ Form::text('rfc', null, ['title'=>'Este campo es obligatorio y debe estar compuesto de 13 caracteres.', 'data-equals'=>'13']) }}
                <div class="message-error">
                    {{ $errors->first('rfc', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('classification', 'Clasificación: ', ['class'=>'label50']) }}
                {{ Form::text('classification', null, ['title'=>'']) }}
                <div class="message-error">
                    {{ $errors->first('classification', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('email', 'Correo electrónico: ', ['class'=>'label50']) }}
                {{ Form::text('email', null, ['title'=>'Este campo debe contener un email valido.', 'data-email'=>'email']) }}
                <div class="message-error">
                    {{ $errors->first('email', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('number', 'Teléfono: ', ['class'=>'label50']) }}
                {{ Form::text('number', null, ['name'=>'number', 'title'=>'Este campo debe ser númerico.', 'data-integer'=>'integer', 'data-error'=>'0']) }}
                <div class="message-error">
                    {{ $errors->first('number', '<span>:message</span>') }}
                </div>
            </div>
        </div>

        <div class="flo col50">
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
                {{ Form::text('postcode', null, ['class'=>'text-right', 'title'=>'Este campo debe ser un número entero y de 5 digitos.', 'data-integer'=>'integer', 'data-equals'=>'5']) }}
                <div class="message-error">
                    {{ $errors->first('postcode', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('address', 'Dirección: ', ['class'=>'label50']) }}
                {{ Form::text('address', null, ['title'=>'']) }}
                <div class="message-error">
                    {{ $errors->first('address', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('address_warranty', 'Dirección de garantías: ', ['class'=>'label50']) }}
                {{ Form::text('address_warranty', null, ['title'=>'']) }}
                <div class="message-error">
                    {{ $errors->first('address_warranty', '<span>:message</span>') }}
                </div>
            </div>
        </div>
    </div>
    <div class="col col100">

        <hr/>

        <div class="flo col50">
            <div class="row">
                {{ Form::label('observations', 'Observaciones: ') }}
                {{ Form::textarea('observations', null, ['title'=>'', 'rows'=>'3']) }}
                <div class="message-error">
                    {{ $errors->first('observations', '<span>:message</span>') }}
                </div>
            </div>
        </div>

        <div class="flo col50">
            <div class="row">
                {{ Form::label('days_credit', 'Días de credito otorgados: ', ['class'=>'label50']) }}
                {{ Form::text('days_credit', null, ['class'=>'text-right', 'title'=>'Este campo debe ser de tipo entero.', 'data-integer'=>'integer']) }}
                <div class="message-error">
                    {{ $errors->first('days_credit', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('credit_limit', 'Límite de credito: ', ['class'=>'label50']) }}
                {{ Form::text('credit_limit', null, ['class'=>'text-right', 'title'=>'Este campo debe ser numerico.', 'data-numeric'=>'numeric']) }}
                <div class="message-error">
                    {{ $errors->first('credit_limit', '<span>:message</span>') }}
                </div>
            </div>
        </div>
    </div>
</fieldset>

<div class="col col100 text-center">
    {{ Form::submit('Registrar') }}
    {{ Form::reset('Limpiar Formulario') }}
</div>
{{ Form::close() }}