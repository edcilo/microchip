@if(p(10) AND !$bank->active)

    {{ Form::open(['route' => ['bank.destroy', $bank->id], 'method' => 'delete', 'role' => 'form']) }}

        <button type="submit" class="btn-red form_confirm">
            <i class="fa fa-times"></i>
            Eliminar banco
        </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar marca" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar al banco <strong>{{ $bank->name }}</strong>?</p>
        </div>
    </div>
@endif
