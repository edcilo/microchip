@extends('layouts/layout_sist')

@section ('title') / Facturas de compras @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2>Facturas de compras</h2>
        </div>

        <div class="flo col30 text-center">
            @include('purchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $results ) > 0 )

            @include('purchase.partials.list_paginate_search')

        @else

            <p class="title-clear">No se obtuvieron resultados.</p>

        @endif

    </div>

@stop
