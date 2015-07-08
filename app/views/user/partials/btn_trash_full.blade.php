@if( p(28) AND $user->active )

    {{ Form::open(['route'=>['user.soft.delete', $user->id], 'method'=>'get']) }}
    <button type="submit" class="btn-red form_confirm" data-confirm="trash_confirm">
        <i class="fa fa-trash"></i>
        Enviar a la papelera.
    </button>
    {{ Form::close() }}

    <div class="confirm-dialog hide" title="Enviar a la papelera" id="trash_confirm" data-width="400">
        <div class="mesasge text-center">
            <p>¿Estas seguro de querer enviar a la papelera al empleado <strong>{{ $user->profile->full_name }}</strong>?</p>
        </div>
    </div>

    @endif
