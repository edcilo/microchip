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

            {{ Form::model($product, ['route'=>['product.description.update', $product->id], 'method'=>'put', 'files'=>'true', 'class'=>'form validate', 'novalidate']) }}
            @include('productDescription/partials/formCreate')

        </div>

    </div>

@stop
