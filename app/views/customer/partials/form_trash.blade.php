@if( p(66) AND $customer->active AND $customer->id != 1 )

    {{ Form::open(['route' => ['customer.soft.delete', $customer->id], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}
    <div class="row text-right">
        <button type="submit" class="btn-red">
            <i class="fa fa-trash"></i>
            Enviar a la papelera
        </button>
    </div>
    {{ Form::close() }}

    @endif