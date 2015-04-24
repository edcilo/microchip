@if( p(89) AND ( $order->status == 'Emitido'))

    {{ Form::open(['route'=>['order.cancel', $order->id], 'class' => 'inline']) }}

    <button type="submit" class="btn-red">
        <i class="fa fa-ban"></i>
        Cancelar pedido
    </button>

    {{ Form::close() }}

@endif