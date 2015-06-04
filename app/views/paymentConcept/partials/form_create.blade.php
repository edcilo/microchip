<div class="row">
    {{ Form::label('concept', 'Concepto: ', ['class'=>'label50']) }}
    {{ Form::text('concept', null, ['title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
    <div class="message-error">
        {{ $errors->first('concept', '<span>:message</span>') }}
    </div>
</div>

<div class="col col100">

    <div class="flo col50">

        <div class="row">
            {{ Form::checkbox('spending', 1, null, ['id'=>'spending']) }}
            {{ Form::label('spending', 'Manejar como gasto') }}
            <div class="message-error">
                {{ $errors->first('spending', '<span>:message</span>') }}
            </div>
        </div>

    </div>

    <div class="flo col50">

        <div class="row">
            {{ Form::label('document', 'Gasto relacionado con:') }}
            {{ Form::select('document', [''=>'Ninguno', 'Venta'=>'Venta', 'Pedido'=>'Pedido', 'Servicio'=>'Servicio'], null, []) }}
            <div class="message-error">
                {{ $errors->first('document', '<span>:message</span>') }}
            </div>
        </div>

    </div>


</div>
