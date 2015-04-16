@if( p(38) )

    <a class="btn-red btn-recycle" title="Enviar a la papelera" href="#" data-id="{{ $provider->id }}" data-name="{{ $provider->name }}">
        <i class="fa fa-trash"></i>
    </a>

    @endif