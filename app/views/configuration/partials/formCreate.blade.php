<div class="col col100"></div>

<div class="col col100">
    <div class="flo col50 left">
        <div class="row">
            {{ Form::label('iva', 'I.V.A (%): ', ['class'=>'label50']) }}
            {{ Form::text('iva', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('iva', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 right">
        <div class="row">
            {{ Form::label('dollar', 'Valor del dolar ($): ', ['class'=>'label50']) }}
            {{ Form::text('dollar', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('dollar', '<span>:message</span>') }}
            </div>
        </div>
    </div>
</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Guardar cambios') }}
</div>


{{ Form::close() }}