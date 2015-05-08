@extends('layouts/layout_sist')

@section ('title') / Registrar garantía @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar garantía</h2>
        </div>

        <div class="flo col40 text-right">
            @include('warranty.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('warranty.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Formulario de registro de garantía</h2>

            {{ Form::open(['route'=>'warranty.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
            @include('warranty.partials.form_create')

            <div class="row text-center">
                {{ Form::submit('Registrar') }}
                {{ Form::reset('Limpiar formulario') }}
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop
