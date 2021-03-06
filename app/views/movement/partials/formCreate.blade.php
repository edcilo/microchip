{{ Form::open(['route'=>'movement.store', 'method'=>'post', 'class'=>'form validate']) }}

<div class="col col100">
    <div class="row flo col33 left">
        {{ Form::label('status', 'Status: ', ['class'=>'label50']) }} <br/>
        {{ Form::select('status', trans('selects.movements_status'), null, ['autofocus', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('status', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col33 center">
        {{ Form::label('barcode', 'Producto: ', ['class'=>'label50']) }} <br/>
        {{ Form::text('barcode', null, ['title'=>'Este campo es obligatorio.', 'id'=>'barcode', 'class'=>'bg-input text-uppercase stopEnter nextInput', 'autocomplete'=>'off', 'data-required'=>'required', 'data-url'=>route('api.product.search', ['null', 'null'])]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="product_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col33 right">
        {{ Form::label('quantity', 'Cantidad: ', ['class'=>'label50']) }} <br/>
        {{ Form::text('quantity', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio.', 'data-integer-unsigned'=>'integer', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100">
    <div class="row flo col33 left">
        <div class="hide show_in">
            {{ Form::label('purchase_price', 'Precio de compra ($): ', ['class'=>'label50']) }} <br/>
            {{ Form::text('purchase_price', 0.00, ['class'=>'text-right', 'title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('purchase_price', '<span>:message</span>') }}
            </div>
        </div>
        &nbsp;
    </div>

    <div class="flo col33 right">
        {{ Form::label('description', 'Descripción: ', ['class'=>'label50']) }} <br/>
        {{ Form::textarea('description', null, ['title'=>'Este campo es obligatorio.', 'data-max'=>'255', 'data-required'=>'required', 'rows'=>3]) }}
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>
</div>

<hr/>

<div class="col col100 text-center">

    {{ Form::submit('Guardar') }}

</div>

{{ Form::close() }}
