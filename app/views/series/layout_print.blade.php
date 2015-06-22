@include('layouts.partials.style_print')

<style>
    @page {
        margin: 0.25cm 0 0;
    }
</style>

@if (count($series) > 1)

    @foreach($series as $s)
        <div class="barcode">
            {{ DNS1D::getBarcodeHTML($s->product->barcode, "C128", $configuration->width_real_bar_product_barcode, $configuration->height_real_product_barcode) }}
        </div>
        {{ $s->product->barcode }}
        <br/>
        <br/>

        <div class="barcode">
            {{ DNS1D::getBarcodeHTML($s->ns, "C128", $configuration->width_real_bar_series_barcode, $configuration->height_real_series_barcode) }}
        </div>
        {{ $s->ns }}
    @endforeach

@else
    <div class="barcode">
        {{ DNS1D::getBarcodeHTML($series->product->barcode, "C128", $configuration->width_real_bar_product_barcode, $configuration->height_real_product_barcode) }}
    </div>
    {{ $series->product->barcode }}
    <br/>
    <br/>

    <div class="barcode">
        {{ DNS1D::getBarcodeHTML($series->ns, "C128", $configuration->width_real_bar_series_barcode, $configuration->height_real_series_barcode) }}
    </div>
    {{ $series->ns }}
@endif