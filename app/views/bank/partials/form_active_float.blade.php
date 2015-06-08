@if(p(9))
    <div class="confirm-dialog hide" title="Devolver banco" id="dialogRestore" data-width="500">
        <div class="message text-center">
            <h4>¿Esta seguro de querer devolver al banco <span class="data_name"></span>?</h4>
        </div>
    </div>

    {{ Form::open(['route' => ['bank.restore', 'PRODUCT_ID'], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}{{ Form::close() }}
@endif
