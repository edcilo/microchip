{{ Form::open(['route'=>['support.authorize', $product->id], 'class'=>'form validate']) }}

<div class="subtitle_mark">
    Autorizar
</div>

<div class="row col col100">
    <div class="flo col33 left">
        {{ Form::label('given_by', 'Entregado por:') }}
        {{ Form::password('given_by', ['autofocus', 'class'=>'xb-input', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('given_by', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 center">
        {{ Form::label('received_by', 'Recibido por:') }}
        {{ Form::password('received_by', ['class'=>'xb-input', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('received_by', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 right">
        {{ Form::label('authorized_by', 'Autorizado por:') }}
        {{ Form::password('authorized_by', ['class'=>'xb-input', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('authorized_by', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="text-center">
    <button type="submit" class="btn-blue">
        Autorizar
    </button>
</div>

{{ Form::close() }}