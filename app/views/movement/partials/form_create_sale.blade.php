{{ Form::hidden('sale_id', $sale->id) }}

<div class="col col100">

    <div class="flo col30 left">
        <label for="barcode"><i class="fa fa-barcode"></i></label>
        {{ Form::text('barcode', null, ['autofocus', 'title'=>'Este campo es obligatorio.', 'id'=>'barcode', 'class'=>'bg-input text-uppercase stopEnter nextInput', 'autocomplete'=>'off', 'data-required'=>'required', 'data-url'=>route('api.product.search', ['null', 1])]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="product_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
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
        <div class="hide product_price">
            {{ Form::label('selling_price', 'Precio:') }}
            {{ Form::text('selling_price', null, ['autocomplete'=>'off', 'data-required'=>'required', 'data-numeric'=>'numeric', 'class'=>'text-right sm-input', 'data-url'=>route('api.product.prices', 'PRODUCT_BARCODE')]) }}
            <div class="message-error">
                {{ $errors->first('selling_price', '<span>:message</span>') }}
            </div>
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
