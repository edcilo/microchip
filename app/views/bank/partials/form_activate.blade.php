@if(p(9) AND !$bank->active)

    {{ Form::open(['route' => ['bank.restore', $bank->id], 'method' => 'get', 'role' => 'form', 'id' => 'form-active']) }}

        <button type="submit" class="btn-green">
            <i class="fa fa-arrow-up"></i>
            Reactivar el banco
        </button>

    {{ Form::close() }}

@endif
