@extends('layouts/layout_sist')

@section ('title') / Productos en soporte @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Productos en soporte</h2>
        </div>

        <div class="flo col20 text-right">
            @include('support.partials.btn_create')
        </div>

        <div class="flo col20 text-right">
            @include('support.partials.form_filter')
        </div>

        <div class="flo col30 text-right">
            @include('support.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @include('support.partials.list_paginate')

    </div>

@stop
