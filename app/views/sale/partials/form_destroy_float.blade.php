@if(p(81))

<div class="confirm-dialog hide" title="Eliminar producto" id="dialogConfirm" data-width="400">
    <div class="mesasge text-center">
        <h3>¿Estas seguro de querer eliminar la partida <span class="data_name"></span>?</h3>
    </div>
</div>
{{ Form::open(['route' => ['sale.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
