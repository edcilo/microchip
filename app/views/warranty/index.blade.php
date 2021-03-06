@extends('layouts/layout_sist')

@section ('title') / Garantías @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-truck"></i> Garantías</h2>
        </div>

        <div class="flo col40 text-right">
            @include('warranty.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('warranty.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $warranties ) > 0 )

            @include('warranty.partials.list_paginate')

            @include('warranty.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay garantías registradas.</p>

        @endif

    </div>

    @include('warranty.partials.form_create_float')

@stop
