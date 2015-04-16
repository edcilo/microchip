@extends('layouts/layout_sist')

@section('title') / {{ $bank->name }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
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

            @include('bank.partials.btn_show')
        </div>

        @include('bank.partials.data')

    </div>

    <div class="col col100 block description-product">
        <div class="header">Nuevo movimiento en {{ $bank->name }}</div>

        {{ Form::open(['route'=>['bankCount.store', $bank->id], 'method'=>'post', 'class'=>'form validate']) }}
        @include('bankCount.partials.form_create')
    </div>


@stop