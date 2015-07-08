@if( p(95) )

    {{ Form::open(['route'=>['pas.destroy', $pa->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red form_confirm" data-confirm="delete_movement_confirm_{{ $pa->id }}" title="Borrar producto">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar partida" id="delete_movement_confirm_{{ $pa->id }}" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el producto {{ $pa->barcode }} de la lista de productos?</h3>
        </div>
    </div>

@endif
