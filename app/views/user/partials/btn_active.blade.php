@if( p(29) AND !$user->active )

    <a class="btn-green btn-active" href="#" data-id="{{ $user->id }}" data-name="{{ $user->username }}">
        <i class="fa fa-arrow-up"></i>
    </a>

    @endif