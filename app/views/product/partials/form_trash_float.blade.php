@if( p(57) )

    <div class="confirm-dialog hide" title="Eliminar proveedor" id="dialogTrash" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer enviar a la papelera a <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['product.soft.delete', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}{{ Form::close() }}

@endif
