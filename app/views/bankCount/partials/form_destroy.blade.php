@if( p(19) )

    <div class="confirm-dialog hide" title="Eliminar movimiento" id="dialogConfirm" data-width="500">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el movimiento de <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['bankCount.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
