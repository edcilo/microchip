{{ Form::open(['route'=>['order.product.store'], 'method'=>'post', 'class'=>'form validate']) }}
{{ Form::hidden('pa_id', $pa->id) }}

<div class="message-error">
    {{ $errors->first('selling_price', '<span>:message</span>') }}
</div>

<div class="row col col100 text-center">

    <div class="flo col33 left">
        {{ Form::label('barcode', 'Código de barras:') }}
        {{ Form::text('barcode', null, ['autofocus', 'title'=>'Este campo es obligatorio.', 'id'=>'barcode', 'class'=>'text-uppercase stopEnter nextInput', 'autocomplete'=>'off', 'data-required'=>'required', 'data-url'=>route('api.product.search', ['null', 1])]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="product_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 center">
        {{ Form::label('quantity', 'Cantidad:') }}
        {{ Form::text('quantity', $pa->orders_rest, ['class'=>'xs-input', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col33 right">
        <button type="submit" class="btn-green inline">
            <i class="fa fa-archive"></i>
            Asignar producto
        </button>
    </div>
</div>

{{ Form::close() }}
