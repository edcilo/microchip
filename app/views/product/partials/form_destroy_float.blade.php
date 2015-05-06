@if(p(59))

    <div class="confirm-dialog hide" title="Eliminar producto" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el producto <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['product.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

    @endif
