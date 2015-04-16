@if( p(30) )

    <a class="btn-red btn-delete" href="#" data-id="{{ $user->id }}" data-name="{{ $user->username }}">
        <i class="fa fa-times"></i>
    </a>

    @endif