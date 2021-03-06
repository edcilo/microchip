@extends('layouts/layout_sist')

@section ('title') / Descripción del producto @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-circle"></i> Datos del producto</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            @include('product.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Datos del producto</h2>

            {{ Form::open(['route'=>'product.description.store', 'method'=>'post', 'files'=>'true', 'class'=>'form validate', 'novalidate']) }}

            @include('productDescription/partials/formCreate')

            <div class="col col100 row text-center">
                <button type="submit" class="btn-green">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
            {{ Form::close() }}

        </div>

    </div>

@stop
