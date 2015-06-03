@extends('layouts/layout_sist')

@section ('title') / Reporte de utilidades @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/vendor/chart.js/Chart.min.js') }}

    <script>
        var data = {{ $data_chart }};
        var options = {
            animationSteps: 40
        };
        var ctx = $("#ChartUser").get(0).getContext("2d");
        var LineChart = new Chart(ctx).Line(data, options);
    </script>
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-area-chart"></i> Reporte de utilidades</h2>
        </div>

        <div class="flo col60 text-right">
            @include('reportUtility.partials.btn_create')
        </div>
    </div>

    @include('reportUtility.partials.chart')

    <div class="col col100">

        @if ( count( $reports ) > 0 )

            @include('reportUtility.partials.list_paginate')

        @else

            <p class="title-clear">No hay reportes de utilidades registrados.</p>

        @endif

    </div>

@stop
