@if( p(58) )

    <div class="confirm-dialog hide" title="Devolver proveedor" id="dialogRestore" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer devolver a <span class="data_name"></span>?</h4>
        </div>
    </div>

    {{ Form::open(['route' => ['product.restore', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}{{ Form::close() }}

@endif
