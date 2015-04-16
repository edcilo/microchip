@if( p(70) )

    <div class="confirm-dialog hide" title="Eliminar banco" id="dialogConfirm" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer eliminar al cliente referido <span class="data_name"></span> de forma definitiva?</h4>
        </div>
    </div>
    {{ Form::open(['route' => ['referrer.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif