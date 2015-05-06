@if( p(70) )

    <a class="btn-red btn-delete" title="Eliminar referido" href="#" data-id="{{ $referenced->id }}" data-name="{{ $referenced->referenced->name }}">
        <i class="fa fa-times"></i>
    </a>

@endif
