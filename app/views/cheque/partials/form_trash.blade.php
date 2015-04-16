@if( p(14) )

    <div class="confirm-dialog hide" title="Eliminar cheque" id="dialogTrash" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer enviar a la papelera al cheque <span id="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['cheque.soft.delete', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}{{ Form::close() }}

@endif