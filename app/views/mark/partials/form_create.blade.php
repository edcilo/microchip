<div class="row">
    {{ Form::label('name', 'Nombre de la marca: ', ['class'=>'label50']) }}
    {{ Form::text('name', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
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


<div class="row">
    {{ Form::label('image', 'Imagen: ', ['class'=>'label50']) }}
    <div class="label50">
        {{ Form::file('image', ['data-mimes'=>'jpg,jpeg,png,gif', 'title'=>'Este campo debe contener archivos de tipo imagen (.jpg, .jpeg, .png, .gif)']) }}

        @if( isset($mark) )
            <figure class="flo col20 left">
                <img src="{{ asset($mark->image) }}" alt="{{ $mark->slug }}"/>
            </figure>
        @endif

    </div>
    <div class="message-error">
        {{ $errors->first('image', '<span>:message</span>') }}
    </div>
</div>
