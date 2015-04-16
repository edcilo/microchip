@extends('layouts/layout_sist')

@section ('title') / Registrar categoría @stop

@section('scripts')@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Registrar Categorías</h2>
    </div>

    <div class="flo col40 text-right">
        @include('category.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('category.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <h2 class="header">Formulario de registro de categoría</h2>

        {{ Form::open(['route'=>'category.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('category.partials.form_create')

        <div class="row text-center">
            {{ Form::submit('Registrar') }}
            {{ Form::reset('Limpiar formulario') }}
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop