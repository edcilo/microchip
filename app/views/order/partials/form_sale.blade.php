@if( p(88) AND ( $order->status == 'Emitido') )

    {{ Form::open(['route'=>['order.to.sale', $order->id], 'class'=>'inline']) }}
    <button class="btn-green">
        Vender
    </button>
    {{ Form::close() }}

@endif