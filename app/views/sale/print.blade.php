@extends('layouts/layout_sales')

@section ('title') / Ventas @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="subtitle">
            {{ $sale->type }}
            ({{ $sale->status }})
        </div>

        @include('sale.partials.data')

        @include('sale.partials.list_products')

    </div>

    <div class="col col100">
        <div class="flo col50">
            @include('sale.partials.btn_end')
        </div>

        <div class="flo col50 text-right">
            @include('sale.partials.btn_print')
        </div>
    </div>

    @include('sale.partials.form_adjust_price')

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
