{{ Form::hidden('type', $s_type) }}

<div class="col col100">

    <div class="flo col25 row left">
        {{ Form::label('barcode', 'Código de barras: ') }}
        {{ Form::text('barcode', null, ['class'=>'xb-input text-uppercase', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col75 row center">
        {{ Form::label('s_description', 'Descripción corta: ') }}
        {{ Form::text('s_description', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('s_description', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">

    <div class="flo col25 row left">
        {{ Form::label('warranty', 'Días de garantía: ') }}
        {{ Form::text('warranty', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-integer-unsigned'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('warranty', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('points', 'Puntos por compra (%): ') }} <br/>
        {{ Form::text('points', null, ['class'=>'text-right sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('points', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('r_points', 'Puntos por referido (%): ') }} <br/>
        {{ Form::text('r_points', null, ['class'=>'text-right sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('r_points', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row right">
        {{ Form::label('web', '¿Publicar en la página web?') }} <br/>
        <div class="flo col50">
            {{ Form::radio('web', 1, true) }} Si
        </div>
        <div class="flo col50">
            {{ Form::radio('web', 0, false) }} No
        </div>
        <div class="flo col100 message-error">
            {{ $errors->first('web', '<span>:message</span>') }}
        </div>
    </div>

</div>

@if ($s_type == 'Producto')

    <hr/>

    @include('productDescription.partials.formCreate', ['desc' => (isset($product)) ? $product->pDescription : null])

@else

    @include('product.partials.service_price_bar')

@endif

<div class="col col100">

    <div class="flo col70 row left">

        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Utilidad</th>
                <th>Precio</th>
                <th>Precio I.V.A. (<span id="iva">{{ $iva }}</span> %)</th>
                <th>Precio de oferta</th>
            </tr>
            </thead>
            <tbody class="text-center">
            <tr>
                <th>(1)</th>
                <td>
                    {{ Form::label('utility_1', ' ') }}
                    {{ Form::text('utility_1', isset($product) ? $product->utility_1 : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    %
                </td>
                <td>
                    {{ Form::label('price_1', '$') }}
                    {{ Form::text('price_1', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_1', '<span>:message</span>') }}
                    </div>
                </td>
                <td>
                    {{ Form::label('iva_1', ' ') }}
                    {{ Form::text('iva_1', isset($product) ? $product->getWithIva1Attribute($iva) : '0.00', ['class'=>'sm-input text-right', 'disabled', 'autocomplete'=>'off']) }}
                </td>
                <td>
                    <button type="button" class="btn-yellow" id="uncheck_offer" title="click aqui para desmarcar precio de oferta">
                        <i class="fa fa-ban"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <th>(2)</th>
                <td>
                    {{ Form::label('utility_2', ' ') }}
                    {{ Form::text('utility_2', isset($product) ? $product->utility_2 : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    %
                </td>
                <td>
                    {{ Form::label('price_2', '$') }}
                    {{ Form::text('price_2', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_2', '<span>:message</span>') }}
                    </div>
                </td>
                <td>
                    {{ Form::label('iva_2', ' ') }}
                    {{ Form::text('iva_2', isset($product) ? $product->getWithIva2Attribute($iva) : '0.00', ['class'=>'sm-input text-right', 'disabled', 'autocomplete'=>'off']) }}
                </td>
                <td>
                    {{ Form::radio('offer', 2, false) }}
                </td>
            </tr>
            <tr>
                <th>(3)</th>
                <td>
                    {{ Form::label('utility_3', ' ') }}
                    {{ Form::text('utility_3', isset($product) ? $product->utility_3 : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    %
                </td>
                <td>
                    {{ Form::label('price_3', '$') }}
                    {{ Form::text('price_3', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_3', '<span>:message</span>') }}
                    </div>
                </td>
                <td>
                    {{ Form::label('iva_3', ' ') }}
                    {{ Form::text('iva_3', isset($product) ? $product->getWithIva3Attribute($iva) : '0.00', ['class'=>'sm-input text-right', 'disabled', 'autocomplete'=>'off']) }}
                </td>
                <td>
                    {{ Form::radio('offer', 3, false) }}
                </td>
            </tr>
            <tr>
                <th>(4)</th>
                <td>
                    {{ Form::label('utility_4', ' ') }}
                    {{ Form::text('utility_4', isset($product) ? $product->utility_4 : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    %
                </td>
                <td>
                    {{ Form::label('price_4', '$') }}
                    {{ Form::text('price_4', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_4', '<span>:message</span>') }}
                    </div>
                </td>
                <td>
                    {{ Form::label('iva_4', ' ') }}
                    {{ Form::text('iva_4', isset($product) ? $product->getWithIva4Attribute($iva) : '0.00', ['class'=>'sm-input text-right', 'disabled', 'autocomplete'=>'off']) }}
                </td>
                <td>
                    {{ Form::radio('offer', 4, false) }}
                </td>
            </tr>
            <tr>
                <th>(5)</th>
                <td>
                    {{ Form::label('utility_5', ' ') }}
                    {{ Form::text('utility_5', isset($product) ? $product->utility_5 : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    %
                </td>
                <td>
                    {{ Form::label('price_5', '$') }}
                    {{ Form::text('price_5', null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_5', '<span>:message</span>') }}
                    </div>
                </td>
                <td>
                    {{ Form::label('iva_5', ' ') }}
                    {{ Form::text('iva_5', isset($product) ? $product->getWithIva5Attribute($iva) : '0.00', ['class'=>'sm-input text-right', 'disabled', 'autocomplete'=>'off']) }}
                </td>
                <td>
                    {{ Form::radio('offer', 5, false) }}
                </td>
            </tr>
            </tbody>
        </table>

    </div>

    <div class="flo col30 row right">

        <div class="col col100 row">
            @if ( isset($product) )
                <figure class="flo col25 left">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}">
                </figure>
            @endif

            {{ Form::label('image', 'Imagen: ') }} <br/>
            {{ Form::file('image', ['data-mimes'=>'jpg,jpeg,png,gif', 'title'=>'Este campo debe contener archivos de tipo imagen (.jpg, .jpeg, .png, .gif)']) }}
            <div class="message-error">
                {{ $errors->first('image', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('description', 'Descripción larga: ', ['class'=>'label50']) }} <br/>
            {{ Form::textarea('description', null, ['rows'=>'6', 'class'=>'xb-input']) }}
            <div class="message-error">
                {{ $errors->first('description', '<span>:message</span>') }}
            </div>
        </div>
    </div>

</div>


<div class="row text-center">
    {{ Form::submit('Guardar') }}
    {{ Form::reset('Limpiar formulario') }}
</div>

{{ Form::close() }}