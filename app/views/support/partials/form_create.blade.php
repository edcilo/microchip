<div class="row col col100">

    <div class="flo col25 left">
        {{ Form::label('barcode', 'Producto:') }}
        <br>
        {{ Form::text('barcode', null, ['class'=>'xb-input text-uppercase stopEnter nextInput', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'autofocus', 'autocomplete'=>'off', 'data-url'=>route('api.product.search', ['null', 1])]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="product_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col10 center">
        {{ Form::label('quantity', 'Cantidad:') }}
        <br>
        {{ Form::text('quantity', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-integer', 'autocomplete'=>'off']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col50 center">
        <label>Descripción</label>
        <input type="text" class="xb-input" disabled value="">
    </div>

    <div class="flo col15 right">
        <label>P. Costo:</label>
        <br>
        $
        <input type="text" class="sm-input text-right" disabled value="0.00">
    </div>

</div>

<div class="row col col100">

    <div class="flo col33 left">
        <div class="subtitle_mark">
            Marcar producto como:
        </div>

        <div class="col col100">

            <div class="flo col33">
                {{ Form::radio('status', 'Gasto', null, ['id' => 'status_gasto']) }}
                {{ Form::label('status_gasto', 'Gasto') }}
            </div>

            <div class="flo col33">
                {{ Form::radio('status', 'Uso', null, ['id' => 'status_uso']) }}
                {{ Form::label('status_uso', 'Uso') }}
            </div>

            <div class="flo col33">
                {{ Form::radio('status', 'Prestamo', null, ['id' => 'status_prestamo']) }}
                {{ Form::label('status_prestamo', 'Prestamo') }}
            </div>

        </div>
        <div class="message-error">
            {{ $errors->first('status', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col66 right">
        {{ Form::label('observations', 'Observaciones:') }}
        <br>
        {{ Form::textarea('observations', null, ['class'=>'xb-input', 'rows'=>3, 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('observations', '<span>:message</span>') }}
        </div>
    </div>

</div>

<hr>