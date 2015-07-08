@if( p(8) AND $bank->active )

    {{ Form::open(['route' => ['bank.soft.delete', $bank->id], 'method' => 'get', 'role' => 'form']) }}

    <button type="submit" class="btn-red form_confirm" data-confirm="trash_confirm">
        <i class="fa fa-trash"></i>
        Enviar a la papelera
    </button>

    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Enviar a la papelera" id="trash_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer enviar a la papelera al banco <strong>{{ $bank->name }}</strong>?</p>
        </div>
    </div>

@endif