@include('layouts.partials.style_print')


@if($sale->type == 'Factura')

    @include('layouts.layout_bill')

@else

    @include('layouts.layout_ticket')

@endif
