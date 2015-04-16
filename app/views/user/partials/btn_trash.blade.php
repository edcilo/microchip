@if( p(28) AND $user->active )

    <a class="btn-red btn-recycle" title="Despedir empleado {{ $user->username }}" href="#" data-id="{{ $user->id }}" data-name="{{ $user->username }}">
        <i class="fa fa-trash"></i>
    </a>

    @endif