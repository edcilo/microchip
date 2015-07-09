@include('layouts.partials.style_print')

<style>
    @page {
        margin: 0.25cm 0 0;
    }
</style>

<div class="barcode">
    {{ DNS1D::getBarcodeHTML($product->barcode, "C128", $configuration->width_real_bar_product_barcode, $configuration->height_real_product_barcode) }}
</div>
{{ $product->barcode }}
<br/>
<br/>