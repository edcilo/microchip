<div class="row">
    {{ Form::label('series', 'Número de serie: ', ['class'=>'label50']) }}
    {{ Form::text('series', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
    <div class="message-error">
        {{ $errors->first('series', '<span>:message</span>') }}
    </div>
</div>


<div class="row">
    {{ Form::label('description', 'Descripción: ', ['class'=>'label50']) }}
    {{ Form::textarea('description', null, ['rows'=>'3', 'class'=>'label50', 'data-required'=>'required']) }}
    <div class="message-error">
        {{ $errors->first('description', '<span>:message</span>') }}
    </div>
</div>