@extends('layouts/layout_sist')

@section ('title') / Editar {{ $company->name }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-bank"></i> Editar datos de la empresa</h2>
        </div>

        <div class="flo col40 text-right">
            @include('company.partials.btn_show')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2>Formulario de edición de {{ $company->name }}</h2>
            </div>

            {{ Form::model($company, ['route'=>['company.update', $company->id], 'method'=>'put', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
            @include('company.partials.form_create')

        </div>

    </div>

@stop
