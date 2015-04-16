@if( p(99) )

    {{ Form::open(['route'=>['order.to.sale', $sale->id], 'method'=>'post', 'class'=>'form inline']) }}
    <div class="message-error">
        {{ $errors->first('product_id', '<span>:message</span>') }}
        {{ $errors->first('quantity', '<span>:message</span>') }}
        {{ $errors->first('purchase_price', '<span>:message</span>') }}
        {{ $errors->first('selling_price', '<span>:message</span>') }}
    </div>
    <button class="btn-green">
        Vender
    </button>
    {{ Form::close() }}

    @endif