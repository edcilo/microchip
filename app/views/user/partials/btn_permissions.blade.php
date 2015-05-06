@if( p(34) )

    <a href="{{ route('permission.user.edit', [$user->id]) }}" class="btn-green" title="Modificar permisos">
        <i class="fa fa-key"></i>
        Modificar permisos
    </a>

    @endif
