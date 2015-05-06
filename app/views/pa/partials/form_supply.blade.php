{{ Form::open(['route'=>['order.product.store'], 'method'=>'post', 'class'=>'form validate']) }}
{{ Form::hidden('pa_id', $pa->id) }}

<div class="message-error">
    {{ $errors->first('selling_price', '<span>:message</span>') }}
</div>

<div class="row col col100 text-center">

    <div class="flo col33 left">
        {{ Form::label('product_id', 'Código de barras:') }}
        {{ Form::text('product_id', null, ['class'=>'', 'autofocus', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('product_id', '<span>:message</span>') }}
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
