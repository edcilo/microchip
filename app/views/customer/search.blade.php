@extends('layouts/layout_sist')

@section('title') / Buscar clientes @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-search"></i> Clientes</h2>
        </div>

        <div class="flo col40 text-right">
            @include('customer.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $results ) > 0 )

            @include('customer.partials.list_paginate_search')

            @include('customer.partials.form_trash_float')

            @include('customer.partials.form_active_float')

            @include('customer.partials.form_destroy_float')

        @else

            <p class="title-clear">No se obtuvierón resultados.</p>

        @endif
    </div>

@stop