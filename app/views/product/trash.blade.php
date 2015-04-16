@extends('layouts/layout_sist')

@section ('title') / Productos eliminados @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-trash"></i> Productos eliminados</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            @include('product.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @if ( count( $products ) > 0 )

            @include('product.partials.list_paginate_trash')

            @include('product.partials.form_active_float')

            @include('product.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay productos eliminados.</p>

        @endif

    </div>

@stop