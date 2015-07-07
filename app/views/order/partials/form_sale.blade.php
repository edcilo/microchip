@if( p(88) AND ( $order->status == 'Emitido' OR $order->status == 'Pagado') )

    {{ Form::open(['route'=>['order.to.sale', $order->id], 'class'=>'inline']) }}
    <button type="submit" class="btn-green form_confirm" data-confirm="sale_confirm">
        Vender
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Vender pedido" id="sale_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer vender el pedido {{ $order->folio }}?</h3>
        </div>
    </div>

@endif
