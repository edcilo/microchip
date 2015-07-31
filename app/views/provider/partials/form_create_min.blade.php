{{ Form::open(['route'=>'provider.store', 'method'=>'post', 'role'=>'form', 'class' => 'form validate']) }}

{{ Form::hidden('back', 1) }}

<div class="col col100">

    <div class="row">
        {{ Form::label('name', 'Nombre: ', ['class'=>'label50']) }}
        {{ Form::text('name', null, ['title'=>'Este campo es obligatorio.', 'class'=>'xb-input', 'data-required'=>'required', 'data-error'=>'0']) }}
        <div class="message-error">
            {{ $errors->first('name', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        {{ Form::label('email', 'Correo electrónico: ', ['class'=>'label50']) }}
        {{ Form::text('email', null, ['title'=>'Este campo debe contener un email valido.', 'data-email'=>'email', 'data-error'=>'0']) }}
        <div class="message-error">
            {{ $errors->first('email', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        {{ Form::label('number', 'Teléfono: ', ['class'=>'label50']) }}
        {{ Form::text('number', null, ['name'=>'number', 'title'=>'Este campo debe ser númerico.', 'data-integer'=>'integer', 'data-error'=>'0']) }}
        <div class="message-error">
            {{ $errors->first('phone', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row">
        {{ Form::label('observations', 'Oservaciones: ') }}
        {{ Form::textarea('observations', null, ['rows'=>'3']) }}
        <div class="message-error">
            {{ $errors->first('observations', '<span>:message</span>') }}
        </div>
    </div>

    {{ Form::submit('Registrar') }}
</div>

{{ Form::close() }}
