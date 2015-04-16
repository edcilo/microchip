@extends('layouts/layout_sist')

@section('title') / Papelera de bancos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">

        <div class="flo col60">
            <h2><i class="fa fa-trash"></i> Bancos eliminados</h2>
        </div>

        <div class="flo col40 text-right">
            @include('bank.partials.form_search')
        </div>

    </div>

    <div class="col col100">

        @if ( count( $banks ) > 0 )

            @include('bank.partials.list_paginate_trash')

            @include('bank.partials.form_active')

            @include('bank.partials.form_destroy')

        @else

            <p class="title-clear">No hay bancos en la papelera.</p>

        @endif

    </div>

@stop