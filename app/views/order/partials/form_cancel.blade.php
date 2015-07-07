@if( p(89) AND ( $order->status == 'Emitido' OR $order->status == 'Pagado'))

    {{ Form::open(['route'=>['order.cancel', $order->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red form_confirm" data-confirm="cancel_confirm">
        <i class="fa fa-ban"></i>
        Cancelar pedido
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Cancelar pedido" id="cancel_confirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer cancelar el pedido {{ $order->folio }}?</h3>
        </div>
    </div>

@endif
