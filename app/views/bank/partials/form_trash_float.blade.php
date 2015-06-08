@if( p(8) )

    <div class="confirm-dialog hide" title="Eliminar banco" id="dialogTrash" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer enviar a la papelera al banco <span class="data_name"></span>?</h3>
        </div>
    </div>

    {{ Form::open(['route' => ['bank.soft.delete', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}{{ Form::close() }}

@endif
