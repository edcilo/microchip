@if( p(87) )

    {{ Form::open(['route'=>['pas.destroy', $movement->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red form_confirm" data-confirm="delete_movement_confirm_{{ $movement->id }}" title="Borrar producto">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar partida" id="delete_movement_confirm_{{ $movement->id }}" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el producto {{ $movement->product->barcode }} de la lista de venta?</h3>
        </div>
    </div>

@endif
