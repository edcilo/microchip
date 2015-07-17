@extends('layouts/layout_sist')

@section ('title') / Corte de caja @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">&nbsp;</div>

        <div class="flo col60 text-right">
            @include('report.partials.btn_index')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>Reporte no. {{ $corte->id }}</h1>

            @include('report.partials.btn_edit', ['report' => $corte])
        </div>

        <div class="col col100">

            @include('report.partials.message')

            <div class="flo col50 left">
                @include('report.partials.general_data')
            </div>

            <div class="flo col50 right">
                @include('report.partials.calculator_show', ['total'=>$report['total_box'], 'd'=>$corte->toArray()])
            </div>

        </div>

    </div>

    @include('report.partials.list_cash')

    @include('report.partials.list_expenses')

    @include('report.partials.list_credit_card')

    @include('report.partials.list_transfers')

    @include('report.partials.lists_cheques')

    @include('report.partials.list_coupons')

    @include('report.partials.list_card')

    <hr/>

    @include('report.partials.users')

@stop
