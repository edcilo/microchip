@extends('layouts/layout_sist')

@section ('title') / Corte de caja @stop

@section('scripts')
    {{ HTML::script('js/report_money.js') }}
@stop

@section ('content')

    <div class="col col100 text-center">
        @include('report.partials.form_dates')
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>
                <i class="fa fa-book"></i>
                Corte de caja
            </h1>
        </div>

        <div class="col col100">

            <aside class="msg_dialog text-center hide"></aside>

            {{ Form::open(['route'=>['report.money.update', $corte->id], 'method'=>'put', 'class'=>'form']) }}

            <div class="flo col50 left">
                @include('report.partials.general_data')

                <hr/>

                @include('report.partials.form_update')
            </div>

            <div class="flo col50 right">
                @include('report.partials.calculator')
            </div>

            {{ Form::close() }}

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
