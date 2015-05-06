@if( p(56) AND $product->active )
    <a class="btn-yellow" href="{{ route('product.edit', [$product->slug, $product->id]) }}">
        <i class="fa fa-pencil"></i>
    </a>
@endif
