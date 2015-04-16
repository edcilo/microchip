@if( p(66) )

    <div class="confirm-dialog hide" title="Eliminar cliente" id="dialogTrash" data-width="400">
        <div class="mesasge text-center">
            <h3>¿Estas seguro de querer enviar a la papelera al cliente <span class="data_name"></span>?</h3>
        </div>
    </div>
    {{ Form::open(['route' => ['customer.soft.delete', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}{{ Form::close() }}

    @endif