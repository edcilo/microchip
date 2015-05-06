@extends('layouts/layout_sist')

@section ('title') / PAs @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2>Productos ordenados</h2>
        </div>

        <div class="flo col50 text-right">
            @include('pa/partials/form_search')
        </div>
    </div>

    <div class="col col100">

        @if( count($pas) )

            @include('pa.partials.list_paginate')

        @else

            <p class="title-clear">No hay productos ordenados.</p>

        @endif

    </div>

@stop
