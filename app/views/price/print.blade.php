@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="subtitle">
            Cotización
            ({{ $sale->status }})
        </div>

        <div class="col col100">
            <div class="flo col50">
                @include('sale.partials.btn_end')
            </div>

            <div class="flo col50 text-right">
                @include('price.partials.btn_print')
            </div>
        </div>

        @include('price/partials/header')

        @include('price.partials.list_products')

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop