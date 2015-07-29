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