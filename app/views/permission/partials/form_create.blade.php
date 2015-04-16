<div class="row">
    {{ Form::label('name', 'Nombre de la categoría: ', ['class'=>'label50']) }}
    {{ Form::text('name', null, ['class'=>'bg-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
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

<hr/>


<div class="row text-center">

    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar cambios
    </button>

</div>