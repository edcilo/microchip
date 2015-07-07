@if( p(67) AND !$customer->active )

    {{ Form::open(['route' => ['customer.restore', $customer->id], 'method' => 'get', 'id' => 'form-active']) }}
    <div class="text-right">
        <button type="submit" class="btn-green form_confirm" data-confirm="restore_confirm">
            <i class="fa fa-arrow-up"></i>
            Restaurar cliente
        </button>
    </div>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Papelera" id="restore_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer recuperar al cliente <strong>{{ $customer->name }}</strong>?</p>
        </div>
    </div>

@endif
