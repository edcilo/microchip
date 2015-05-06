@extends('layouts/layout_sales')

@section ('title') @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 left">

        @include('layouts/partials/nav_options_sale')

        <p class="title-clear">
            <img src="{{ asset('images/sist/soft.png') }}" alt="Microchip"/>
        </p>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
