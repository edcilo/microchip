@if( p(96) )

    {{ Form::open(['route'=>['service.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red form_confirm" type="submit" title="Eliminar venta">
        <i class="fa fa-times"></i>
        Eliminar servicio
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar servicio" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer salir del servicio actual?</p>
        </div>
    </div>

@endif
