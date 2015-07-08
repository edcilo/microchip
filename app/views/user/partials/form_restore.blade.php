@if( p(29) AND !$user->active )

    {{ Form::open(['route' => ['user.restore', $user->id], 'method' => 'get']) }}
    <button type="submit" class="btn-green form_confirm" data-confirm="restore_confirm">
        <i class="fa fa-arrow-up"></i>
        Recuperar
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Recuperar de papelera" id="restore_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer recuperar de la papelera al empleado <strong>{{ $user->profile->full_name }}</strong>?</p>
        </div>
    </div>

@endif
