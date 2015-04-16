@extends('layouts/layout_sist')

@section('title') / Buscar bancos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-search"></i> Bancos</h2>
    </div>

    <div class="flo col40 text-right">
        @include('bank.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('bank.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $results ) > 0 )

        @include('bank.partials.list_paginate_complete')

        @include('bank.partials.form_trash')

        @include('bank.partials.form_active')

        @include('bank.partials.form_destroy')

    @else

        <p class="title-clear">No se obtuvierón resultados.</p>

    @endif
</div>

@stop