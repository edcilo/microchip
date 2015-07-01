@extends('layouts/layout_sist')

@section ('title') / Pedidos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Pedidos</h2>
        </div>

        <div class="flo col40 text-right">
            @include('order.partials.btn_create')
        </div>

        <div class="flo col30 text-right">
            @include('order/partials/form_search')
        </div>
    </div>

    <div class="col col100">

        @if (count($orders))

            @include('order.partials.list_paginate')

        @else

            <p class="title-clear">No hay pedidos registradas.</p>

        @endif

    </div>

@stop
