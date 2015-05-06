@extends('layouts/layout_sist')

@section ('title') / Registrar marca @stop

@section('scripts')@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Registrar Marca</h2>
    </div>

    <div class="flo col40 text-right">
        @include('mark.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('mark.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <h2 class="header">Formulario de registro de marca</h2>

        {{ Form::open(['route'=>'mark.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('mark.partials.form_create')

        <div class="row text-center">
            {{ Form::submit('Registrar') }}
            {{ Form::reset('Limpiar formulario') }}
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop
