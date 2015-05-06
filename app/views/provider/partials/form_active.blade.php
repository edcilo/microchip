@if( p(39) )

    <div class="confirm-dialog hide" title="Devolver proveedor" id="dialogRestore" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer devolver al provedor <span class="data_name"></span>?</h4>
        </div>
    </div>

    {{ Form::open(['route' => ['provider.restore', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}{{ Form::close() }}

    @endif
