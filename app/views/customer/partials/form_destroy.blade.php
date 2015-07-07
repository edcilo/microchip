@if( p(68) AND !$customer->active )

    {{ Form::open(['route' => ['customer.destroy', $customer->id], 'method' => 'delete']) }}
    <button type="submit" class="btn-red form_confirm" data-confirm="destroy_confirm">
        <i class="fa fa-times"></i>
        Eliminar cliente
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Eliminar cliente" id="destroy_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar al cliente <strong>{{ $customer->name }}</strong>?</p>
        </div>
    </div>

@endif
