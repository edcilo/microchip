@if( p(137) )

    <div class="confirm-dialog hide" title="Eliminar categoría" id="dialogConfirm" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer eliminar el concepto "<strong><span class="data_name"></span></strong>"?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['concept.destroy', 'PRODUCT_ID'], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}{{ Form::close() }}

@endif
