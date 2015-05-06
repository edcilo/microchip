@extends('layouts/layout_sist')

@section ('title') / Buscar en inventario @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-search"></i> Resultados de busqueda</h2>
    </div>

    <div class="flo col40 text-right">&nbsp;</div>

    <div class="flo col30 text-right">
        @include('product.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $results ) > 0 )

        @include('product.partials.list_paginate_search')

        @include('product.partials.form_active_float')

        @include('product.partials.form_trash_float')

        @include('product.partials.form_destroy_float')

    @else

        <p class="title-clear">No se obtuvieron resultados.</p>

    @endif

</div>

@stop
