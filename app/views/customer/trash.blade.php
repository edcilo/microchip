@extends('layouts/layout_sist')

@section('title') / Clientes eliminados @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">

        <div class="flo col70">
            <h2><i class="fa fa-trash"></i> Clientes eliminados</h2>
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>

    </div>

    <div class="col col100">

        @if ( count( $customers ) > 0 )

            @include('customer.partials.list_paginate_trash')

            @include('customer.partials.form_active_float')

            @include('customer.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay clientes registrados.</p>

        @endif

    </div>

@stop