<a href="{{ route('series.create.purchase', [$movement->id, $movement->product->id]) }}" class="btn-green add-series" title="Agregar numeros de serie" data-movement="{{ $movement->id }}" data-quantity="{{ $movement->in_stock  }}" data-product="{{ $movement->product->id }}" data-barcode="{{ $movement->product->barcode  }}">
    <strong>N/S</strong>
</a>
