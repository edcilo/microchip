@extends('layouts/layout_sist')

@section ('title') / Editar {{ $product->type }} @stop

@section('scripts')
    {{ HTML::script('js/products.js') }}
    {{ HTML::script('js/search_provider.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Editar {{ $product->type }}</h2>
    </div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('product.index.' . $product->r_type) }}">
            <i class="fa fa-list"></i> Volver a la lista de {{ $product->type }}
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('product.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <div class="header">
            <h2>Formulario de edición de {{ $product->type }}</h2>
            <a class="btn-blue" href="{{ route('product.show', [$product->slug, $product->id]) }}"><i class="fa fa-eye"></i></a>
        </div>

        {{ Form::model($product, ['route'=>['product.update', $product->id], 'method'=>'put', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('product.partials.form_create')

    </div>

</div>

@stop

