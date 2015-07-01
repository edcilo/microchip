@if( p(108))
    {{ Form::open(['route'=>['price.destroy', $sale->id], 'method'=>'delete']) }}
    <button class="btn-red form_confirm" type="submit" title="Eliminar cotización">
        <i class="fa fa-times"></i>
        Eliminar cotización
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar cotización" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer salir de la cotización actual?</p>
        </div>
    </div>
@endif
