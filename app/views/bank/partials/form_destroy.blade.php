@if(p(10) AND !$bank->active)

    {{ Form::open(['route' => ['bank.destroy', $bank->id], 'method' => 'delete', 'role' => 'form', 'id' => 'form-delete']) }}

        <button type="submit" class="btn-red">
            <i class="fa fa-times"></i>
            Eliminar banco
        </button>

    {{ Form::close() }}

@endif
