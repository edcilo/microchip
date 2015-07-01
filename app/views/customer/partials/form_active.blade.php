@if( p(67) AND !$customer->active )

    {{ Form::open(['route' => ['customer.restore', $customer->id], 'method' => 'get', 'id' => 'form-active']) }}
    <div class="text-right">
        <button type="submit" class="btn-green">
            <i class="fa fa-arrow-up"></i>
            Restaurar cliente
        </button>
    </div>
    {{ Form::close() }}

    @endif
