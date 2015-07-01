@if( p(81) )

    {{ Form::open(['route'=>['sale.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red form_confirm" type="submit" title="Eliminar venta">
        <i class="fa fa-times"></i>
        Eliminar venta
    </button>
    {{ Form::close() }}


    <div class="confirm-dialog hide" title="Eliminar venta" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer salir de la venta actual?</p>
        </div>
    </div>

@endif
