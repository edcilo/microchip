@extends('layouts/layout_sist')

@section ('title') / Ventas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Ventas</h2>
        </div>

        <div class="flo col40 text-right">
            @include('sale.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('sale.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $sales ) > 0 )

            @include('sale.partials.list_paginate')

            @include('sale.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay ventas registradas.</p>

        @endif

    </div>

@stop
