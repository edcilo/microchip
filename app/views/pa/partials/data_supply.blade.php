<div class="col col100">
    <figure class="flo col10 left">
        <img src="{{ asset($order->product->image) }}" alt="{{ $order->product->barcode }}"/>
    </figure>
    <div class="flo col20 center">
        <strong>Producto:</strong> <br/>
        <a href="{{ route('product.show', [$order->product->slug, $order->product->id]) }}">
            {{ $order->product->barcode }}
        </a>
    </div>
    <div class="flo col20 center">
        <strong>Cantidad:</strong> <br/>
        {{ $order->quantity }}
    </div>
    <div class="flo col50 right">
        <strong>Descripción corta:</strong>
        {{ $order->product->s_description }}
    </div>
</div>