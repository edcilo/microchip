@extends('layouts/layout_sist')

@section ('title') / Marcas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Marcas</h2>
        </div>

        <div class="flo col40 text-right">
            @include('mark.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('mark.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $marks ) > 0 )

            @include('mark.partials.list_paginate')

            @include('mark.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay marcas registradas.</p>

        @endif

    </div>

    @include('mark.partials.form_create_float')

@stop
