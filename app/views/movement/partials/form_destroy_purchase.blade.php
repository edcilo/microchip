@if( p(61) AND $purchase->progress_4 )

    {{ Form::open(['route'=>['movement.destroy', $movement->id], 'method'=>'delete', 'class'=>'inline']) }}
    <button type="submit" class="btn-red form_confirm" data-confirm="destroy_confirm">
        <i class="fa fa-times"></i>
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminat producto" id="destroy_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar al cliente <strong>{{ $movement->product->barcode }}</strong>?</p>
        </div>
    </div>

@endif
