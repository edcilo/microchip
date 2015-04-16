@if( p(44) )

    <div class="confirm-dialog hide" title="Eliminar marca" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar la marca <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['mark.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

    @endif