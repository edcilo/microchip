@extends('layouts/layout_sist')

@section ('title') / Cotizaciones @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Cotizaciones</h2>
        </div>

        <div class="flo col40 text-right">
            @include('price.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('price/partials/form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $prices ) > 0 )

            @include('price.partials.list_paginate')

        @else

            <p class="title-clear">No hay cotizaciones registradas.</p>

        @endif

    </div>

@stop
