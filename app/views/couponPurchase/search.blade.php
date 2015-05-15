@extends('layouts/layout_sist')

@section ('title') / Notas de crédito @stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-search"></i> Resultados de notas de crédito</h2>
        </div>

        <div class="flo col30 text-right">
            @include('couponPurchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('couponPurchase.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $results ) > 0 )

            @include('couponPurchase.partials.list_paginate', ['coupons' => $results])

        @else

            <p class="title-clear">No se obtuvieron resultados.</p>

        @endif

    </div>

@stop
