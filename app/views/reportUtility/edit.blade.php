@extends('layouts/layout_sist')

@section ('title') / Editar Reporte de utilidades {{ $report->id }} @stop

@section ('content')

    <div class="col col100 text-center">
        @include('reportUtility.partials.form_dates')
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>
                <i class="fa fa-area-chart"></i>
                Reporte de utilidades
            </h1>
        </div>

        @include('reportUtility.partials.data')

        <hr/>

        @include('reportUtility.partials.form_update')

    </div>

    @include('reportUtility.partials.list_sales')

@stop
