@if( p(68) AND !$customer->active AND $customer->id != 1 )

    <a class="btn-red btn-delete" title="Eliminar del sistema" href="#" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">
        <i class="fa fa-times"></i>
    </a>

    @endif
