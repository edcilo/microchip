@extends('layouts/layout_sist')

@section ('title') / Servicios @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-circle"></i> Servicios</h2>
        </div>

        <div class="flo col40 text-right">
            @include('product.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('product.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $services ) > 0 )

            @include('product.partials.list_paginate_services')

            @include('product.partials.form_trash_float')

        @else
            <p class="title-clear">No hay servicios registrados.</p>
        @endif

    </div>

@stop
