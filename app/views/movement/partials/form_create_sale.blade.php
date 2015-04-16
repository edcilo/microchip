{{ Form::hidden('sale_id', $sale->id) }}

<div class="col col100">

    <div class="flo col30 left">
        <label for="product_id"><i class="fa fa-barcode"></i></label>
        {{ Form::text('product_id', null, ['data-required'=>'required', 'class'=>'bg-input', 'autocomplete'=>'off', 'autofocus', 'placeholder'=>'Código de barras del producto.']) }}
        <div class="message-error">
            {{ $errors->first('product_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col15 center">
        {{ Form::label('quantity', 'Cantidad:') }}
        {{ Form::text('quantity', 1, ['autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer', 'class'=>'text-right xs-input']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 center">
        {{ Form::label('selling_price', 'Precio:') }}
        {{ Form::text('selling_price', null, ['autocomplete'=>'off', 'data-required'=>'required', 'data-numeric'=>'numeric', 'class'=>'text-right sm-input']) }}
        <div class="message-error">
            {{ $errors->first('selling_price', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col15 center">
        <button type="submit" class="btn-green">
            <i class="fa fa-cart-plus"></i>
        </button>
    </div>

    @if($sale->classification != 'Venta')
    <div class="flo col20 right text-right">
        <a href="{{ route('pas.create', [$sale->id]) }}" class="btn-blue">
            <i class="fa fa-plus"></i>
            PA
        </a>
    </div>
    @endif

</div>

{{ Form::close() }}