@if( p(74) )

    <div class="confirm-dialog hide" title="Eliminar pago" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el pago por <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['pay.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
