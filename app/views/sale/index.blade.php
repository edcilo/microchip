@extends('layouts/layout_sist')

@section ('title') / Ventas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2>Ventas</h2>
        </div>

        <div class="flo col50 text-right">
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