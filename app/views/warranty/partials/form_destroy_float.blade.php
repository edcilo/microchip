<div class="confirm-dialog hide" title="Eliminar garantía" id="dialogConfirm" data-width="400">
    <div class="mesasge text-center">
        <h3>¿Estas seguro de querer eliminar la garantía <span class="data_name"></span>?</h3>
    </div>
</div>
{{ Form::open(['route' => ['warranty.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}