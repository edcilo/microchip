<a href="{{ route('product.change.prices', [$movement->product->slug, $movement->product->id]) }}" class="btn-yellow" title="Cambiar precios">
    @if($movement->purchase_price == $movement->product->p_description->purchase_price)
        <i class="fa fa-circle"></i>
    @elseif($movement->purchase_price > $movement->product->p_description->purchase_price)
        <i class="fa fa-arrow-up"></i>
    @else
        <i class="fa fa-arrow-down"></i>
    @endif
</a>