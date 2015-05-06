@extends('layouts/layout_sist')

@section ('title') / {{ $product->barcode }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('product.partials.btn_index_service')
        </div>

        <div class="flo col30 text-right">
            @include('product.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $product->barcode }}</h1>

            @include('product.partials.btn_edit')
        </div>

        @include('product.partials.data')

    </div>

    @include('product.partials.data_price')

    @include('product.partials.data_series')

    @include('product.partials.form_trash')

    @include('product.partials.form_active')

    @include('product.partials.form_destroy')

@stop
