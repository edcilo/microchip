<a href="
    @if($sale->classification == 'Venta')
        {{ route('sale.show', $sale->id) }}
    @elseif($sale->classification == 'Pedido')
        {{ route('order.show', $sale->id) }}
    @else
        {{ route('service.show', $sale->id) }}
    @endif
">
    {{ $sale->folio }}
</a>