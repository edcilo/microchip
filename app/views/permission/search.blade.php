@extends('layouts/layout_sist')

@section ('title') / Buscar permisos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-search"></i> Resultados de permisos</h2>
    </div>

    <div class="flo col40 text-right">
        @include('permission.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('permission.partials.form_search')
    </div>
</div>

<div class="col col100">

    @if ( count( $results ) > 0 )

        @include('permission.partials.list_paginate', ['permissions' => $results])

    @else

        <p class="title-clear">No se obtuvieron resultados.</p>

    @endif

</div>

@stop
