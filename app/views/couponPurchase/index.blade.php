@extends('layouts/layout_sist')

@section ('title') / Notas de crédito @stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-ticket"></i> Notas de crédito</h2>
        </div>

        <div class="flo col40 text-right">
            @include('couponPurchase.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $coupons ) > 0 )

            @include('couponPurchase.partials.list_paginate')

        @else

            <p class="title-clear">No hay notas de crédito registradas.</p>

        @endif

    </div>

@stop
