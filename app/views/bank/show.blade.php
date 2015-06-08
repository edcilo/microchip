@extends('layouts/layout_sist')

@section('title') / {{ $bank->name }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/cheques_script.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('bank.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('bank.partials.form_search')
        </div>
    </div>


    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $bank->name }}</h1>

            @include('bank.partials.btn_edit')
        </div>

        @include('bank.partials.data')

        <hr/>

        <div class="text-right">
            @include('bank.partials.form_trash')

            <div class="flo col50 text-center">
                @include('bank.partials.form_activate')
            </div>

            <div class="flo col50 text-center">
                @include('bank.partials.form_destroy')
            </div>
        </div>

    </div>

    @include('cheque.index')

@stop
