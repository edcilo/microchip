@extends('layouts/layout_sist')

@section ('title') / Datos de la empresa @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-bank"></i> Datos de la empresa</h2>
        </div>

        <div class="flo col70 text-right">&nbsp;</div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Registrar datos de la empresa</h2>

            {{ Form::open(['route'=>'company.store', 'method'=>'post', 'files'=>'true', 'class'=>'form validate']) }}
            @include('company.partials.form_create')

        </div>

    </div>

@stop