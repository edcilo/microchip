@if( p(87) )

    {{ Form::open(['route'=>['order.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red form_confirm" type="submit" title="Eliminar venta">
        <i class="fa fa-times"></i>
        Eliminar pedido
    </button>
    {{ Form::close() }}


    <div class="confirm-dialog hide" title="Eliminar pedido" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer salir del pedido actual?</p>
        </div>
    </div>

@endif
