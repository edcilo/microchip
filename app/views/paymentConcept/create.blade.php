@extends('layouts/layout_sist')

@section ('title') / Registrar Conceptos de gastos @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-list-ul"></i> Registrar Conceptos de gastos</h2>
        </div>

        <div class="flo col30 text-right">
            @include('paymentConcept.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('paymentConcept.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Formulario de registro de concepto de gastos</h2>

            {{ Form::open(['route'=>'concept.store', 'method'=>'post', 'novalidate', 'class'=>'form validate']) }}
            @include('paymentConcept.partials.form_create')

            <div class="row text-center">
                {{ Form::submit('Registrar') }}
                {{ Form::reset('Limpiar formulario') }}
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop
