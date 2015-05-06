@if( p(26) AND $user->active )

    <a class="btn-yellow" title="Editar perfil" href="{{ route('user.profile.edit', [$user->slug, $user->profile->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>

    @endif
