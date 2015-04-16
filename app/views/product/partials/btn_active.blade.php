@if( p(58) AND !$product->active)

    <a class="btn-green btn-active" href="#" data-id="{{ $product->id }}" data-name="{{ $product->barcode }}">
        <i class="fa fa-arrow-up"></i>
    </a>

    @endif