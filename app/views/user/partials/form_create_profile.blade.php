<div class="flo col50 left">
    <fieldset>
        <legend>Datos personales</legend>

        <div class="row">
            {{ Form::label('photo', 'Fotografía: ', ['class'=>'label50']) }}
            {{ Form::file('photo', ['title'=>'Este campo solo acepta archivos JPG, JPEG, PNG, GIF.', 'data-mimes'=>'jpg,jpeg,png,gif']) }}
            <div class="message-error">
                {{ $errors->first('photo', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('name', 'Nombre:', ['class'=>'label50']) }}
            {{ Form::text('name', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('name', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('f_last_name', 'Apellido paterno:', ['class'=>'label50']) }}
            {{ Form::text('f_last_name', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('f_last_name', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('s_last_name', 'Apellido materno:', ['class'=>'label50']) }}
            {{ Form::text('s_last_name', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('s_last_name', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('sex', 'Sexo: ', ['class'=>'label50']) }}
            {{ Form::select('sex', ['0'=>'Seleccione...', 'Masculino'=>'Masculino', 'Femenino'=>'Femenino'], null, ['title'=>'Seleccione una opción valida de la lista', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('sex', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('birthday', 'Fecha de nacimiento:', ['class'=>'label50']) }}
            {{ Form::text('birthday', null, ['placeholder'=>'YYYY-MM-DD', 'title'=>'Este campo es obligatorio y debe seguir el siguiente formato de fecha "yyyy-mm-dd"', 'data-required'=>'required', 'data-date'=>'date']) }}
            <div class="message-error">
                {{ $errors->first('birthday', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('marital_status', 'Estado civil: ', ['class'=>'label50']) }}
            {{ Form::select('marital_status', ['0'=>'Seleccione...', 'Casado'=>'Casado', 'Soltero'=>'Soltero'], null, ['title'=>'Seleccione una opción valida de la lista', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('marital_status', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('wife', 'Nombre completo del cónyuge:', ['class'=>'label50']) }}
            {{ Form::text('wife', null, ['title'=>'', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('wife', '<span>:message</span>') }}
            </div>
        </div>
    </fieldset>
</div>

<div class="flo col50 right">
    <fieldset>
        <legend>Datos de contacto</legend>

        <div class="row">
            {{ Form::label('phone', 'Teléfono fijo:', ['class'=>'label50']) }}
            {{ Form::text('phone', null, ['title'=>'Este campo debe contener un valor numerico con al menos 6 dígitos.', 'data-numeric'=>'numeric', 'data-min'=>'6']) }}
            <div class="message-error">
                {{ $errors->first('phone', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('cellphone', 'Teléfono celular:', ['class'=>'label50']) }}
            {{ Form::text('cellphone', null, ['title'=>'Este campo debe contener un valor numerico con al menos 6 dígitos.', 'data-numeric'=>'numeric', 'data-min'=>'6']) }}
            <div class="message-error">
                {{ $errors->first('cellphone', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('email', 'Correo electrónico:', ['class'=>'label50']) }}
            {{ Form::text('email', null, ['title'=>'Este campo es obligatorio y debe tener un email valido.', 'data-email'=>'email', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('email', '<span>:message</span>') }}
            </div>
        </div>

        <hr/>

        <div class="row">
            {{ Form::label('country', 'País:', ['class'=>'label50']) }}
            {{ Form::text('country', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('country', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('state', 'Estado:', ['class'=>'label50']) }}
            {{ Form::text('state', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('state', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('city', 'Ciudad:', ['class'=>'label50']) }}
            {{ Form::text('city', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('city', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('postcode', 'Código postal:', ['class'=>'label50']) }}
            {{ Form::text('postcode', null, ['title'=>'Este campo es obligatorio y debe ser un número entero de 5 dígitos.', 'data-required'=>'required', 'data-integer'=>'integer', 'data-equals'=>'5']) }}
            <div class="message-error">
                {{ $errors->first('postcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('colony', 'Colonia:', ['class'=>'label50']) }}
            {{ Form::text('colony', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('colony', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('address', 'Dirección:', ['class'=>'label50']) }}
            {{ Form::text('address', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
            <div class="message-error">
                {{ $errors->first('address', '<span>:message</span>') }}
            </div>
        </div>
    </fieldset>
</div>

<div class="col col100">

    <fieldset>
        <legend>Referencias</legend>

        <div class="flo col50">

            <div class="row">
                {{ Form::label('reference_1', 'Referencia 1:', ['class'=>'label50']) }}
                {{ Form::text('reference_1', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
                <div class="message-error">
                    {{ $errors->first('reference_1', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('reference_2', 'Referencia 2:', ['class'=>'label50']) }}
                {{ Form::text('reference_2', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
                <div class="message-error">
                    {{ $errors->first('reference_2', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('reference_3', 'Referencia 3:', ['class'=>'label50']) }}
                {{ Form::text('reference_3', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-max'=>'255']) }}
                <div class="message-error">
                    {{ $errors->first('reference_3', '<span>:message</span>') }}
                </div>
            </div>

        </div>

        <div class="flo col50">

            <div class="row">
                {{ Form::label('ref_phone_1', 'Teléfono:', ['class'=>'label50']) }}
                {{ Form::text('ref_phone_1', null, ['title'=>'Este campo debe contener un valor numerico con al menos 6 dígitos.', 'data-numeric'=>'numeric', 'data-min'=>'6']) }}
                <div class="message-error">
                    {{ $errors->first('ref_phone_1', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('ref_phone_2', 'Teléfono:', ['class'=>'label50']) }}
                {{ Form::text('ref_phone_2', null, ['title'=>'Este campo debe contener un valor numerico con al menos 6 dígitos.', 'data-numeric'=>'numeric', 'data-min'=>'6']) }}
                <div class="message-error">
                    {{ $errors->first('ref_phone_2', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('ref_phone_3', 'Teléfono:', ['class'=>'label50']) }}
                {{ Form::text('ref_phone_3', null, ['title'=>'Este campo debe contener un valor numerico con al menos 6 dígitos.', 'data-numeric'=>'numeric', 'data-min'=>'6']) }}
                <div class="message-error">
                    {{ $errors->first('ref_phone_3', '<span>:message</span>') }}
                </div>
            </div>

        </div>

    </fieldset>

</div>

<div class="col col100">

    <fieldset>
        <legend>Datos de empleo</legend>

        <div class="flo col50">
            <div class="row">
                {{ Form::label('hired', 'Fecha de contrato (YYYY-MM-DD):', ['class'=>'label50']) }}
                {{ Form::text('hired', date('Y-m-d'), ['title'=>'Este campo es obligatorio y debe seguir el siguiente formato de fecha "yyyy-mm-dd"', 'data-required'=>'required', 'data-date'=>'date']) }}
                <div class="message-error">
                    {{ $errors->first('hired', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('salary', 'Salario:', ['class'=>'label50']) }}
                $ {{ Form::text('salary', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio y debe ser un valor numerico"', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
                <div class="message-error">
                    {{ $errors->first('salary', '<span>:message</span>') }}
                </div>
            </div>
        </div>

        <div class="flo col50">
            <div class="row">
                {{ Form::label('goal', 'Objetivo de ventas:', ['class'=>'label50']) }}
                $ {{ Form::text('goal', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio y debe ser un valor numerico"', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
                <div class="message-error">
                    {{ $errors->first('goal', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('commission', 'Comisión por ventas:', ['class'=>'label50']) }}
                {{ Form::text('commission', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio y debe ser un valor numerico"', 'data-required'=>'required', 'data-numeric'=>'numeric']) }} %
                <div class="message-error">
                    {{ $errors->first('commission', '<span>:message</span>') }}
                </div>
            </div>

            <div class="row">
                {{ Form::label('observations', 'Observaciones:', ['class'=>'label50']) }}
                {{ Form::textarea('observations', null, ['rows'=>'3', 'class'=>'label50', 'title'=>'Este campo acepta hasta 510 caracteres', 'data-max'=>'510']) }}
                <div class="message-error">
                    {{ $errors->first('observations', '<span>:message</span>') }}
                </div>
            </div>
        </div>
    </fieldset>

</div>