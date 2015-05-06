@extends('layouts/layout_sist')

@section('title') / {{ $bank->name }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('bank.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('bank.partials.form_search')
        </div>
    </div>


    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $bank->name }}</h1>

            @include('bank.partials.btn_show')
        </div>

        @include('bank.partials.data')

    </div>


    @include('bankCount.partials.listCheques')


    <div class="col col100 block description-product">
        <div class="header">Estado de cuenta de {{ $bank->name }}</div>

        <div class="col col100 text-right">
            @include('bankCount.partials.btn_create')
        </div>

        @if(count($counts))

            @include('bankCount.partials.list_paginate')

        @else

            <p class="title-clear">No hay movimientos registrados.</p>

        @endif

    </div>


@stop
