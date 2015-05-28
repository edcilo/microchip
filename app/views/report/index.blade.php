@extends('layouts/layout_sist')

@section ('title') / Cortes de caja @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-book"></i> Cortes de caja</h2>
        </div>

        <div class="flo col60 text-right">
            @include('report.partials.btn_create')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $reports ) > 0 )

            @include('report.partials.list_paginate')

            @include('report.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay cortes de caja registrados.</p>

        @endif

    </div>

@stop
