<div class="col col100">
    {{ Form::hidden('sale_id', $sale->id) }}

    <div class="flo col15 row left">
        {{ Form::label('barcode', 'Codigo de barras: ') }} <br/>
        {{ Form::text('barcode', null, ['autofocus', 'class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('s_description', 'Descripción corta: ') }} <br/>
        {{ Form::text('s_description', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('s_description', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col30 row center">
        {{ Form::label('l_description', 'Descripción larga: ') }} <br/>
        {{ Form::textarea('l_description', null, ['class'=>'xb-input', 'rows'=>'2', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('l_description', '<span>:message</span>') }}
        </div>

        {{ Form::text('provider_link', null, ['class'=>'xb-input', 'placeholder'=>'Enlace del proveedor', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('provider_link', '<span>:message</span>') }}
        </div>

        {{ Form::text('image_link', null, ['class'=>'xb-input', 'placeholder'=>'Enlace de la imagen', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('image_link', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col10 row center">
        {{ Form::label('quantity', 'Cantidad: ') }} <br/>
        {{ Form::text('quantity', null, ['class'=>'xb-input text-right', 'title'=>'Este campo es obligatorio y debe ser un valor entero.', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col15 row center">
        {{ Form::label('selling_price', 'Precio de compra: ') }} <br/>
        {{ Form::text('selling_price', null, ['class'=>'text-right xb-input', 'placeholder'=>'0.00', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('selling_price', '<span>:message</span>') }}
        </div>

        {{ Form::select('w_iva', ['Con Iva', 'Sin Iva'], null, ['class'=>'xb-input', 'title'=>'¿El precio unitario tiene IVA incluido?']) }}
        <div class="message-error">
            {{ $errors->first('w_iva', '<span>:message</span>') }}
        </div>

        {{ Form::select('dollar', ['M.N.', 'Dollar'], null, ['class'=>'xb-input', 'title'=>'Tipo de moneda.']) }}
        <div class="message-error">
            {{ $errors->first('dollar', '<span>:message</span>') }}
        </div>

        {{ Form::text('utility', null, ['class'=>'xb-input text-right', 'title'=>'Tipo de moneda.', 'placeholder'=>'Utilidad (%)', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('utility', '<span>:message</span>') }}
        </div>

        {{ Form::text('shipping', null, ['class'=>'xb-input text-right', 'title'=>'Tipo de moneda.', 'placeholder'=>'Costo de envio ($)', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('shipping', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col10 row right">
        {{ Form::label('total', 'Total:') }}
        {{ Form::text('total', '$ 0.00', ['class'=>'xb-input text-right', 'disabled', 'data-required'=>'required']) }}
    </div>

</div>

<hr/>

<div class="col col100 text-center">
    <button type="submit" class="btn-green">
        Guardar
    </button>
</div>

{{ Form::close() }}
