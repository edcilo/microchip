@if( p(15) )

    <div class="confirm-dialog hide" title="Devolver cheque" id="dialogRestore" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer devolver el cheque <span id="data_name"></span>?</h4>
        </div>
    </div>
    {{ Form::open(['route' => ['cheque.restore', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}{{ Form::close() }}

@endif