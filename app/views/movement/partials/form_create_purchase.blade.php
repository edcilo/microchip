{{ Form::open(['route'=>'movement.purchase.store', 'method'=>'post', 'class'=>'form validate']) }}

{{ Form::hidden('purchase_id', $purchase->id) }}

<div class="col col100">

    <div class="flo col25 left row">
        {{ Form::label('barcode', 'Código de producto:') }} <br/>
        {{ Form::text('barcode', null, ['autofocus', 'title'=>'Este campo es obligatorio.', 'class'=>'text-uppercase', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 center row">
        {{ Form::label('quantity', 'Cantidad:') }} <br/>
        {{ Form::text('quantity', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio y debe ser un numero entero positivo.', 'autocomplete'=>'off', 'data-required'=>'required', 'data-integer-unsigned'=>'integer']) }}
        <div class="message-error">
            {{ $errors->first('quantity', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 center row">
        {{ Form::label('purchase_price', 'Precio de compra:') }} <br/>
        {{ Form::text('purchase_price', null, ['class'=>'text-right', 'title'=>'Este campo es obligatorio y debe ser numerico.', 'autocomplete'=>'off', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('purchase_price', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 right row">

        <br/>

        <button type="submit" class="btn-green">
            Agregar producto
        </button>


        <a class="btn-green" href="{{ route('product.create', 'product') }}" title="Registrar un nuevo producto" target="_blank">
            <i class="fa fa-plus"></i>
        </a>

    </div>

</div>


{{ Form::close() }}
