@if( p(57) AND $product->active )
    <a href="#" class="btn-red btn-recycle" title="Borrar {{ $product->barcode }}" data-id="{{ $product->id }}" data-name="{{ $product->barcode }}">
        <i class="fa fa-trash"></i>
    </a>
@endif
