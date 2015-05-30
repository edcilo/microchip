@extends('layouts/layout_sist')

@section ('title') / Reporte de utilidades @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-area-chart"></i> Reporte de utilidades</h2>
        </div>

        <div class="flo col60 text-right">
            @include('reportUtility.partials.btn_create')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $reports ) > 0 )

            @include('reportUtility.partials.list_paginate')

        @else

            <p class="title-clear">No hay reportes de utilidades registrados.</p>

        @endif

    </div>

@stop
