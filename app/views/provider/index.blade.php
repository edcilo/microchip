@extends('layouts/layout_sist')

@section ('title') / Proveedores @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Proveedores</h2>
        </div>

        <div class="flo col40 text-right">
            @include('provider.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('provider.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $providers ) > 0 )

            @include('provider.partials.list_paginate')

            @include('provider.partials.form_trash')

        @else

            <p class="title-clear">No hay proveedores registradas.</p>

        @endif

    </div>

    @include('provider.partials.form_create_float')

@stop