@extends('layouts/layout_sist')

@section ('title') / Conceptos de gastos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-list-ul"></i> Conceptos de gastos</h2>
        </div>

        <div class="flo col40 text-right">
            @include('paymentConcept.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('paymentConcept.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $concepts ) > 0 )

            @include('paymentConcept.partials.list_paginate')

            @include('paymentConcept.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay conceptos de gastos registrados.</p>

        @endif

    </div>

    @include('paymentConcept.partials.form_create_float')

@stop
