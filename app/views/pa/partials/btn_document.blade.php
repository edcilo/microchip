<a href="
@if($pa->sale->classification == 'Venta')
    {{ route('sale.show', [$pa->sale->id]) }}
@elseif($pa->sale->classification == 'Pedido')
    {{ route('order.show', [$pa->sale->id]) }}
@elseif($pa->sale->classification == 'Cotización')
    {{ route('price.show', [$pa->sale->id]) }}
@else
    {{ route('service.show', [$pa->sale->id]) }}
@endif
" class="btn-green">
    <i class="fa fa-file"></i>
    Volver a {{ $pa->sale->classification }}
</a>