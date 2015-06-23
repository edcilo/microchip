@include('layouts.partials.style_print')

<style>
    @page {
        margin: 0.125cm 0 0
    }
</style>

<div class="barcode_price">
    $ {{ number_format($product->current_price * ($configuration->iva / 100 + 1), 2, '.', ',') }}
</div>

<div class="p"></div>

<div class="barcode">
    {{ DNS1D::getBarcodeHTML($product->barcode, "C128", $configuration->width_real_bar_product_barcode, $configuration->height_real_product_barcode) }}
</div>
{{ $product->barcode }}

<div class="p"></div>

<div class="barcode_description">
    {{ $product->s_description }}
</div>