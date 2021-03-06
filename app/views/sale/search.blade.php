@extends('layouts/layout_sist')

@section ('title') / Ventas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2>
                <i class="fa fa-search"></i>
                Resultados de busqueda en Ventas
            </h2>
        </div>

        <div class="flo col30 text-right">
            @include('sale.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('sale.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $results ) > 0 )

            @include('sale.partials.list_paginate_search')

        @else

            <p class="title-clear">No se obtuvieron resultados.</p>

        @endif

    </div>

@stop
