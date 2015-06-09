@if(p(10) AND !$bank->active)

    {{ Form::open(['route' => ['bank.destroy', $bank->id], 'method' => 'delete', 'role' => 'form']) }}

        <button type="submit" class="btn-red">
            <i class="fa fa-times"></i>
            Eliminar banco
        </button>

    {{ Form::close() }}

@endif
