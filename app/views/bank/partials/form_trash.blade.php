@if( p(8) AND $bank->active )

    {{ Form::open(['route' => ['bank.soft.delete', $bank->id], 'method' => 'get', 'role' => 'form', 'id' => 'form-recycle']) }}

    <button type="submit" class="btn-red">
        <i class="fa fa-trash"></i>
        Enviar a la papelera
    </button>

    {{ Form::close() }}

@endif