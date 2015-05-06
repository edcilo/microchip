@extends('layouts/layout_sist')

@section('title') / Registrar banco @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Bancos</h2>
        </div>

        <div class="flo col40 text-right">
            @include('bank.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('bank.partials.form_search')
        </div>
    </div>

<div class="col col100 block description-product">

    <h2 class="header">Formulario de registro de bancos</h2>

    {{ Form::open(['route'=>'bank.store', 'method'=>'post', 'class'=>'form validate']) }}
    @include('bank.partials.form_create')

</div>

@stop
