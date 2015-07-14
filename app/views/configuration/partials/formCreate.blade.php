<div class="col col100">
    <div class="flo col50 left">

        <div class="subtitle">
            <strong>Compras/Ventas</strong>
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
            <strong>Cupones</strong>
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

    <div class="subtitle">
        <strong>Códigos de barras</strong>
    </div>

    <div class="col col100">

        <div class="flo col60 left">

            <div class="subtitle">
                Código de barras del documento
            </div>

            <div class="col col100 row">
            <div class="flo col70 left">
                {{ Form::label('width_bar_document_barcode', 'Ancho de la barra del codigo de barras de los documentos:') }}
            </div>
            <div class="flo col30 right text-right">
                {{ Form::text('width_bar_document_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                <div class="message-error">
                    {{ $errors->first('width_bar_document_barcode', '<span>:message</span>') }}
                </div>
            </div>
            </div>

            <div class="col col100">
                <div class="flo col60 left">
                    {{ Form::label('height_document_barcode', 'Alto del codigo de barras de los documentos:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('height_document_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                    <div class="message-error">
                        {{ $errors->first('height_document_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="flo col40 right text-center">
            <img src="{{ asset('images/sist/barcode_document.png') }}" alt="codigo de barras de documento">
        </div>

    </div>

        <hr/>

    <div class="col col100">

        <div class="flo col60 left">

            <div class="subtitle">Papel de código de barras de producto</div>

            <div class="col col100 row">
                <div class="flo col60 left">
                    {{ Form::label('width_paper_barcode', 'Ancho de papel:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('width_paper_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en centimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} cm.
                    <div class="message-error">
                        {{ $errors->first('width_paper_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

            <div class="col col100">
                <div class="flo col60 left">
                    {{ Form::label('height_paper_barcode', 'Alto del papel:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('height_paper_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en centimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} cm.
                    <div class="message-error">
                        {{ $errors->first('height_paper_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

            <div class="row"></div>

            <div class="subtitle">Código de barras del producto</div>

            <div class="col col100 row">
                <div class="flo col60 left">
                    {{ Form::label('width_bar_product_barcode', 'Ancho de la barra:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('width_bar_product_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                    <div class="message-error">
                        {{ $errors->first('width_bar_product_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

            <div class="col col100">
                <div class="flo col60 left">
                    {{ Form::label('height_product_barcode', 'Alto del la barra:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('height_product_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                    <div class="message-error">
                        {{ $errors->first('height_product_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

            <div class="row"></div>

            <div class="subtitle">Código de barras del número de serie</div>

            <div class="col col100 row">
                <div class="flo col60 left">
                    {{ Form::label('width_bar_series_barcode', 'Ancho de la barra:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('width_bar_series_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                    <div class="message-error">
                        {{ $errors->first('width_bar_series_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

            <div class="col col100">
                <div class="flo col60 left">
                    {{ Form::label('height_series_barcode', 'Alto de la barra:') }}
                </div>
                <div class="flo col40 right text-right">
                    {{ Form::text('height_series_barcode', null, ['class' => 'sm-input text-right', 'title'=>'Este campo es obligatorio y el valor debe estar expresado en milimetros.', 'data-numeric'=>'numeric', 'autocomplete'=>'off', 'data-required'=>'required']) }} mm.
                    <div class="message-error">
                        {{ $errors->first('height_series_barcode', '<span>:message</span>') }}
                    </div>
                </div>
            </div>

        </div>

        <div class="flo col40 right text-center">
            <img src="{{ asset('images/sist/barcode_description.png') }}" alt="codigo de barras de documento">
        </div>

    </div>

</div>

<div class="col col100 text-center">
    <hr/>

    {{ Form::submit('Guardar cambios') }}
</div>


{{ Form::close() }}
