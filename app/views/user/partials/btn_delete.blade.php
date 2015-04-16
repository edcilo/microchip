@if( p(30) AND !$user->active )

    <a class="btn-red btn-delete" href="#" data-id="{{ $profile->user->id }}" data-name="{{ $profile->user->username }}">
        <i class="fa fa-times"></i>
    </a>

    @endif