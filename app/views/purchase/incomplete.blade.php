@extends('layouts/layout_sist')

@section ('title') / Facturas de compras incompletas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2>Facturas de compras incompletas</h2>
        </div>

        <div class="flo col30 text-center">
            @include('purchase.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('purchase.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $purchases ) > 0 )

            @include('purchase.partials.list_paginate')

        @else

            <p class="title-clear">Aún no se han registrado facturas de compras.</p>

        @endif

    </div>

@stop