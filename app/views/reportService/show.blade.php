@extends('layouts/layout_sist')

@section ('title') / Reporte de servicios @stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">&nbsp;</div>

        <div class="flo col60 text-right">
            @include('reportService.partials.btn_index')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>
                <i class="fa fa-area-chart"></i>
                Reporte de servicios {{ $report->id }} ({{ $report->date_init }} - {{ $report->date_end }})
            </h1>

            @include('reportService.partials.btn_edit')
        </div>

        <ul>
            <li>Total global: $ {{ number_format($services->total, 2, '.', ',') }}</li>
        </ul>

    </div>

    @include('reportService.partials.list_services')

@stop
