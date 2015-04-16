@if( p(67) AND !$customer->active )

    <a class="btn-green btn-active" title="Regresar cliente a la lista" href="#" data-id="{{ $customer->id }}" data-name="{{ $customer->name }}">
        <i class="fa fa-arrow-up"></i>
    </a>

    @endif