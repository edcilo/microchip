<div class="col col100">
    {{ Form::hidden('product_id', $id) }}

    <div class="flo col20 row left">
        {{ Form::label('category_id', 'Categoría: ') }}
        {{ Form::select('category_id', $category_list, null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('category_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('mark_id', 'Marca: ') }}
        {{ Form::select('mark_id', $mark_list, null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('mark_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('model', 'Modelo: ') }}
        {{ Form::text('model', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('model', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col40 row right text-center">
        {{ Form::label('have_series', '¿El producto cuenta con número de serie?') }} <br/>
        <div class="flo col50">
            {{ Form::radio('have_series', 1, true) }} Si
        </div>
        <div class="flo col50">
            {{ Form::radio('have_series', 0, false) }} No
        </div>
        <div class="flo col100 message-error">
            {{ $errors->first('have_series', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100">
    <div class="flo col20 row left">
        {{ Form::label('data_sheet', 'Ficha técnica: ', ['class'=>'label50']) }}
        @if ( isset($product) )
            <a href="{{ asset($product->product->data_sheet) }}" download>
                <i class="fa fa-download"></i> Descargar
            </a>
        @endif
        {{ Form::file('data_sheet', ['class'=>'xb-input', 'title'=>'Este campo solo acepta archivos PDF, JPG, JPEG, PNG, GIF.', 'data-mimes'=>'pdf,jpg,jpeg,png,gif']) }}
        <div class="message-error">
            {{ $errors->first('data_sheet', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col15 row center">
        {{ Form::label('stock_min', 'Stock minimo: ') }} <br/>
        {{ Form::text('stock_min', null, ['class'=>'text-right sm-input', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo debe tener un valor entero sin signo.']) }}
        <div class="message-error">
            {{ $errors->first('stock_min', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col15 row center">
        {{ Form::label('stock_max', 'Stock maximo: ') }} <br/>
        {{ Form::text('stock_max', null, ['class'=>'text-right sm-input', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo debe tener un valor entero sin signo.']) }}
        <div class="message-error">
            {{ $errors->first('stock_max', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col30 row center text-center">
        {{ Form::label('box', '¿El producto se compra por caja?') }} <br/>
        <div class="flo col50">
            {{ Form::radio('box', 1, false) }} Si
        </div>
        <div class="flo col50">
            {{ Form::radio('box', 0, true) }} No
        </div>
        <div class="flo col100 message-error">
            {{ $errors->first('box', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row right">
        {{ Form::label('pieces', 'Número de piezas por caja: ') }}
        {{ Form::text('pieces', 0, ['class'=>'text-right xs-input', 'title'=>'Este campo es obligatorio y debe tener un valor entero positivo.', 'data-required'=>'required', 'data-integer' => 'integer']) }}
        <div class="message-error">
            {{ $errors->first('pieces', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100">
    <div class="flo col25 row left">
        {{ Form::label('purchase_price', 'Precio de compra ($): ') }} <br/>
        {{ Form::text('purchase_price', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('purchase_price', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('provider', 'Proveedor: ') }}
        {{ Form::text('provider', null, ['class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('provider', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('provider_barcode', 'Codigo de barras del proveedor: ') }} <br/>
        {{ Form::text('provider_barcode', null, ['class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('provider_barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row right">
        {{ Form::label('provider_warranty', 'Garantía con el proveedor: ') }} <br/>
        {{ Form::text('provider_warranty', null, ['placeholder'=>'Número de días', 'class'=>'text-right', 'title'=>'Este campo debe contener un número entero positivo.', 'data-integer-unsigned'=>'integer']) }}
        <div class="message-error">
            {{ $errors->first('provider_warranty', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100 row text-center">
    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i> Guardar
    </button>
</div>
