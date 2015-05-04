@extends('layouts/layout_sist')

@section ('title') / Vales @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-ticket"></i> Vales</h2>
        </div>

        <div class="flo col40 text-right">
            @include('coupon.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $coupons ) > 0 )

            @include('coupon.partials.list_paginate')

            @include('coupon.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay vales registrados.</p>

        @endif

    </div>

@stop