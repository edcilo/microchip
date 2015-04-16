<div class="row">
    {{ Form::label('name', 'Nombre: ', ['class'=>'label50']) }}
    {{ Form::text('name', null, ['title'=>'Este campo es obligatorio', 'autocomplete'=>'off', 'data-required'=>'required']) }}
    <div class="message-error">
        {{ $errors->first('name', '<span>:message</span>') }}
    </div>
</div>

<div class="row">
    {{ Form::label('description', 'Descripción: ', ['class'=>'label50']) }}
    {{ Form::textarea('description', null, ['rows'=>'3', 'class'=>'label50']) }}
    <div class="message-error">
        {{ $errors->first('description', '<span>:message</span>') }}
    </div>
</div>

<div class="row text-center">
    {{ Form::submit('Registrar') }}
    {{ Form::reset('Limpiar formulario') }}
</div>

{{ Form::close() }}