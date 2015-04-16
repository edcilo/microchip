@extends('layouts.layout_sist')

@section('title') / Papelera de proveedores @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-trash"></i> Proveedores eliminados</h2>
        </div>

        <div class="flo col40 text-right">
            @include('provider.partials.form_search')
        </div>
    </div>

    <div>

        @if ( count( $providers ) > 0 )

            @include('provider.partials.list_paginate_trash')

            @include('provider.partials.form_active')

            @include('provider.partials.form_destroy')

        @else

            <p class="title-clear">No hay proveedores en la papelera.</p>

        @endif

    </div>

@stop