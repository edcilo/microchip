<div class="col col100">

    <div class="row flo col25">
        {{ Form::label('name', 'Nombre de la empresa:') }} <br/>
        {{ Form::text('name', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('name', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('photo', 'Logotipo (jpeg, jpg, png, gif):') }} <br/>
        {{ Form::file('photo', ['title'=>'Este campo solo acepta imagenes.', 'data-mimes'=>'jpg,jpeg,png,gif']) }}
        <div class="message-error">
            {{ $errors->first('photo', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('owner', 'Nombre de representante:') }} <br/>
        {{ Form::text('owner', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('owner', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('rfc', 'R.F.C:') }} <br/>
        {{ Form::text('rfc', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-equals'=>'13']) }}
        <div class="message-error">
            {{ $errors->first('rfc', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="row flo col25">
        {{ Form::label('state', 'Estado:') }} <br/>
        {{ Form::text('state', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('state', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('city', 'Ciudad:') }} <br/>
        {{ Form::text('city', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('city', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('colony', 'Colonia:') }} <br/>
        {{ Form::text('colony', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('colony', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('address', 'Dirección:') }} <br/>
        {{ Form::text('address', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('address', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('phone_1', 'Teléfono 1:') }} <br/>
        {{ Form::text('phone_1', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('phone_1', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('phone_2', 'Teléfono 2:') }} <br/>
        {{ Form::text('phone_2', null, []) }}
        <div class="message-error">
            {{ $errors->first('phone_2', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('phone_3', 'Teléfono 3 (WhatsApp):') }} <br/>
        {{ Form::text('phone_3', null, []) }}
        <div class="message-error">
            {{ $errors->first('phone_3', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('email', 'Correo electronico:') }} <br/>
        {{ Form::text('email', null, ['title'=>'Este campo es obligatorio y debe contener un correo electronico valido.', 'data-required'=>'required', 'data-email'=>'email']) }}
        <div class="message-error">
            {{ $errors->first('email', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25">
        {{ Form::label('web', 'Página de Internet:') }} <br/>
        {{ Form::text('web', null, []) }}
        <div class="message-error">
            {{ $errors->first('web', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">
    <hr/>

    <div class="flo col50">
        {{ Form::label('services', 'Servicios (separados por ;):') }} <br/>
        {{ Form::textarea('services', null, ['rows'=>'4']) }}
        <div class="message-error">
            {{ $errors->first('services', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col50">
        {{ Form::label('schedule', 'Horarios:') }} <br/>
        {{ Form::text('schedule', null, ['class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('schedule', '<span>:message</span>') }}
        </div>

        {{ Form::label('note', 'Notas:') }} <br/>
        {{ Form::textarea('note', null, ['rows'=>'4', 'class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('note', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Guardar datos') }}

</div>

{{ Form::close() }}
