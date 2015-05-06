@if( p(28) )

    <a href="{{ route('user.soft.delete', [$user->id]) }}" class="btn-red">
        <i class="fa fa-trash"></i> Enviar a la papelera.
    </a>

    @endif
