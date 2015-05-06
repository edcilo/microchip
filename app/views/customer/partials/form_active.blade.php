@if( p(67) AND !$customer->active )

    {{ Form::open(['route' => ['customer.restore', $customer->id], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}
    <div class="row text-right">
        <button type="submit" class="btn-green">
            <i class="fa fa-arrow-up"></i>
            Restaurar cliente
        </button>
    </div>
    {{ Form::close() }}

    @endif
