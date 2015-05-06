@extends('layouts/layout_sist')

@section ('title') / Categorías @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Categorías</h2>
        </div>

        <div class="flo col40 text-right">
            @include('category.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('category.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $categories ) > 0 )

            @include('category.partials.list_paginate')

            @include('category.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay categorías registradas.</p>

        @endif

    </div>

    @include('category.partials.form_create_float')

@stop
