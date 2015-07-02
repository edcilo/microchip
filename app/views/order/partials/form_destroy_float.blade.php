@if(p(87))

<div class="confirm-dialog hide" title="Eliminar pedido" id="dialogConfirm" data-width="400">
    <div class="mesasge text-center">
        <h3>¿Estas seguro de querer eliminar el pedido <span class="data_name"></span>?</h3>
    </div>
</div>
{{ Form::open(['route' => ['order.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
