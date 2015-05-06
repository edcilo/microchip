@if( p(59) AND ! $product->active)
    <a class="btn-red btn-delete" href="#" data-id="{{ $product->id }}" data-name="{{ $product->barcode }}">
        <i class="fa fa-times"></i>
    </a>
@endif
