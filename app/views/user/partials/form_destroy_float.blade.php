@if( p(30) )

    <div class="confirm-dialog hide" title="Eliminar proveedor" id="dialogConfirm" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer eliminar al empleado <span class="data_name"></span> de forma definitiva?</h4>
        </div>
    </div>

    {{ Form::open(['route' => ['user.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

    @endif
