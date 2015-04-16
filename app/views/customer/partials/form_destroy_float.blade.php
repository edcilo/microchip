@if( p(68) )

    <div class="confirm-dialog hide" title="Eliminar banco" id="dialogConfirm" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer eliminar al cliente <span class="data_name"></span> de forma definitiva?</h4>
        </div>
    </div>
    {{ Form::open(['route' => ['customer.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

    @endif