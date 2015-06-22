<div class="col col100">
    <div class="flo col50 left">

        <div class="subtitle">
            Compras/Ventas
        </div>

        <div class="row">
            {{ Form::label('iva', 'I.V.A (%): ', ['class'=>'label50']) }}
            {{ Form::text('iva', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('iva', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('dollar', 'Valor del dolar ($): ', ['class'=>'label50']) }}
            {{ Form::text('dollar', null, ['title'=>'Este campo es obligatorio.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('dollar', '<span>:message</span>') }}
            </div>
        </div>
    </div>

    <div class="flo col50 right">

        <div class="subtitle">
            Cupones
        </div>

        <div class="row">
            {{ Form::label('coupon_effective_days', 'Días de vigencia del cupón:', ['class'=>'label50']) }}
            {{ Form::text('coupon_effective_days', null, ['title'=>'Este campo es obligatorio', 'data-integer-unsigned' => 'integer', 'autocomplete'=>'off', 'data-required'=>'required']) }}
            <div class="message-error">
                {{ $errors->first('coupon_effective_days', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('coupon_terms_use', 'Condiciones de uso para el cupón:') }}
            {{ Form::textarea('coupon_terms_use', null, ['rows' => '2']) }}
            <div class="message-error">
                {{ $errors->first('coupon_terms_use', '<span>:message</span>') }}
            </div>
        </div>
    </div>

</div>

<div class="col col100">

    <div class="flo col50 left">

        <div class="subtitle">
            Códigos de barras
        </div>

        <div class="row">
            {{ Form::label('width_paper_barcode', 'Ancho del papel de impresion de codigo de barras:', ['class'=>'label50']) }}
            {{ Form::text('width_paper_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en centimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} cm.
            <div class="message-error">
                {{ $errors->first('width_paper_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('height_paper_barcode', 'Alto del papel de impresion de codigo de barras:', ['class'=>'label50']) }}
            {{ Form::text('height_paper_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en centimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} cm.
            <div class="message-error">
                {{ $errors->first('height_paper_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <hr/>

        <div class="row">
            {{ Form::label('width_bar_document_barcode', 'Ancho de la barra del codigo de barras de los documentos:', ['class'=>'label50']) }}
            {{ Form::text('width_bar_document_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('width_bar_document_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('height_document_barcode', 'Alto del codigo de barras de los documentos:', ['class'=>'label50']) }}
            {{ Form::text('height_document_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('height_document_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <hr/>

        <div class="row">
            {{ Form::label('width_bar_product_barcode', 'Ancho de la barra del codigo de barras de los productos:', ['class'=>'label50']) }}
            {{ Form::text('width_bar_product_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('width_bar_product_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('height_product_barcode', 'Alto del codigo de barras de los productos:', ['class'=>'label50']) }}
            {{ Form::text('height_product_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('height_product_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <hr/>

        <div class="row">
            {{ Form::label('width_bar_series_barcode', 'Ancho de la barra del codigo de barras de los números de serie:', ['class'=>'label50']) }}
            {{ Form::text('width_bar_series_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('width_bar_series_barcode', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('height_series_barcode', 'Alto del codigo de barras de los números de serie:', ['class'=>'label50']) }}
            {{ Form::text('height_series_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
            <div class="message-error">
                {{ $errors->first('height_series_barcode', '<span>:message</span>') }}
            </div>
        </div>

    </div>

    <div class="flo col50 right"></div>

</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Guardar cambios') }}
</div>


{{ Form::close() }}
