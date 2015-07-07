@if( p(99) )

    {{ Form::open(['route'=>['order.to.sale', $sale->id], 'method'=>'post', 'class'=>'form inline']) }}
    <div class="message-error">
        {{ $errors->first('product_id', '<span>:message</span>') }}
        {{ $errors->first('quantity', '<span>:message</span>') }}
        {{ $errors->first('purchase_price', '<span>:message</span>') }}
        {{ $errors->first('selling_price', '<span>:message</span>') }}
    </div>
    <button class="btn-green form_confirm" data-confirm="sale_confirm">
        Vender
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Vender servicio" id="sale_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer vender el servicio {{ $sale->folio }}?</h3>
        </div>
    </div>

@endif
