@if( p(30) AND !$user->active)

    {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'delete', 'role' => 'form']) }}

    <button class="btn-red form_confirm">
        <i class="fa fa-times"></i> Eliminar empleado
    </button>

    {{ Form::close() }}


    <div class="confirm-dialog hide" title="Eliminar empleado" id="formConfirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer eliminar al empleado <strong>{{ $user->username }}</strong>?</p>
        </div>
    </div>

@endif
