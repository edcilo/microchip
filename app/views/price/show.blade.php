@extends('layouts/layout_sist')

@section ('title') / Cotización @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Cotización</h2>
        </div>

        <div class="flo col40 text-right">
            @include('price.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('price/partials/form_search')
        </div>
    </div>

    <div class="col col100 block description-product left">

        <div class="header">
            <h1>Folio: {{ $sale->folio }}</h1>
            <span>({{ $sale->status }})</span>

            @include('price.partials.btn_print')
        </div>

        @include('price.partials.header')

        @include('price.partials.form_to_order')

    </div>

    @if( $sale->description )
        <div class="block description-product">
            <p class="subtitle">Observaciones:</p>

            {{ $sale->description }}
        </div>
    @endif

@stop