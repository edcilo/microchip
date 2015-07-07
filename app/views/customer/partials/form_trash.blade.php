@if( p(66) AND $customer->active AND $customer->id != 1 )

    {{ Form::open(['route' => ['customer.soft.delete', $customer->id], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}
    <div class="row text-right">
        <button type="submit" class="btn-red form_confirm" data-confirm="trash_confirm">
            <i class="fa fa-trash"></i>
            Enviar a la papelera
        </button>
    </div>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Papelera" id="trash_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer enviar a la papelera al cliente <strong>{{ $customer->name }}</strong>?</p>
        </div>
    </div>

@endif
