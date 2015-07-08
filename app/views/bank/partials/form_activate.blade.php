@if(p(9) AND !$bank->active)

    {{ Form::open(['route' => ['bank.restore', $bank->id], 'method' => 'get', 'role' => 'form']) }}

        <button type="submit" class="btn-green form_confirm" data-confirm="restore_confirm">
            <i class="fa fa-arrow-up"></i>
            Reactivar el banco
        </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Recuperar de la papelera" id="restore_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer recuperar de la papelera al banco <strong>{{ $bank->name }}</strong>?</p>
        </div>
    </div>

@endif
