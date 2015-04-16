@if( p(27) )

    <a href="{{ route('user.edit', [$user->slug, $user->id]) }}" class="btn-yellow" title="Editar datos de usuario">
        <i class="fa fa-pencil"></i>
        <i class="fa fa-user"></i>
    </a>

    @endif