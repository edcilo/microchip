@extends('layouts/layout_sist')

@section ('title') / Servicios descartados @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>
                <i class="fa fa-trash"></i>
                Servicios descartados
            </h2>
        </div>

        <div class="flo col40 text-right">
            @include('service.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('service/partials/form_search')
        </div>
    </div>

    <div class="col col100">

        @if (count($services))

            @include('service.partials.list_paginate')

        @else

            <p class="title-clear">No hay servicios descartados.</p>

        @endif

    </div>

@stop
