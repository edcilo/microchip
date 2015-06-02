@extends('layouts/layout_sist')

@section ('title') / Reporte de servicios @stop

@section ('content')

    <div class="col col100">
        <div class="flo col70">
            @include('reportService.partials.form_dates')
        </div>

        <div class="flo col30 text-right">
            @include('reportService.partials.btn_index')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>
                <i class="fa fa-area-chart"></i>
                Reporte de servicios
            </h1>
        </div>

        <ul>
            <li>Total global: $ {{ number_format($services->total, 2, '.', ',') }}</li>
        </ul>

        <hr/>

        @include('reportService.partials.form_store')

    </div>

    @include('reportService.partials.list_services')

@stop
