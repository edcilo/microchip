@extends('layouts/layout_sist')

@section ('title') / Reorte de utilidades {{ $report->id }} @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">&nbsp;</div>

        <div class="flo col60 text-right">
            @include('reportUtility.partials.btn_index')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>Reporte no. {{ $report->id }}</h1>

            @include('reportUtility.partials.btn_edit')
        </div>

        @include('reportUtility.partials.data')

    </div>

    @include('reportUtility.partials.list_sales')

@stop
