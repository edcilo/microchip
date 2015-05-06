@if( p(40) )

    <a class="btn-red btn-delete" title="Eliminar del sistema" href="#" data-id="{{ $provider->id }}" data-name="{{ $provider->name }}">
        <i class="fa fa-times"></i>
    </a>

    @endif
