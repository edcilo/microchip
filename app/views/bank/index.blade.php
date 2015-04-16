@extends('layouts/layout_sist')

@section('title') / Bancos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Bancos</h2>
        </div>

        <div class="flo col40 text-right">
            @include('bank.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('bank/partials/form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $banks ) > 0 )

            @include('bank.partials.list_paginate')

            @include('bank.partials.form_trash')

        @else

            <p class="title-clear">Aún no se han registrado bancos.</p>

        @endif
    </div>

    @include('bank.partials.form_create_float')

@stop