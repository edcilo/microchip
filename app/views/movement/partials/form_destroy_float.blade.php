@if( p(53) )

    <div class="confirm-dialog hide" title="Eliminar categoría" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el movimiento de <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['movement.destroy.simple', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
