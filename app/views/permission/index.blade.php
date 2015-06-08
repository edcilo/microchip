@extends('layouts/layout_sist')

@section ('title') / Permisos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col70">
            <h2><i class="fa fa-key"></i> Permisos</h2>
        </div>

        <div class="flo col30 text-right">
            @include('permission.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        @include('permission.partials.list_paginate')

    </div>

@stop
