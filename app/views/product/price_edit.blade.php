@extends('layouts/layout_sist')

@section ('title') / Cambiar precios de {{ $product->type }} @stop

@section('scripts')
    {{ HTML::script('js/products.js') }}
    {{ HTML::script('js/search_provider.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-tag"></i> Cambiar precios de {{ $product->type }}</h2>
        </div>

        <div class="flo col40 text-right">
            <a href="{{ route('purchase.show', [$movement->purchases[0]->folio, $movement->purchases[0]->id]) }}" class="btn-blue">
                Volver a la compra
            </a>
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2>Formulario de edición de precios</h2>
                <a class="btn-blue" href="{{ route('product.show', [$product->slug, $product->id]) }}" title="Ver detalles del producto">
                    <i class="fa fa-eye"></i>
                </a>
            </div>

            {{ Form::open(['route'=>['product.update.prices', $product->id], 'method'=>'put', 'class'=>'form validate']) }}

            @include('product.partials.service_price_bar', ['desc' => $movement])

            <div class="col col100">

                <div class="flo col50 left">
                    <div class="subtitle_mark">
                        Precios actuales
                    </div>

                    @include('product.partials.price_table')
                </div>

                <div class="flo col50 right">
                    <div class="subtitle_mark">
                        Precios sugeridos
                    </div>

                    @include('product.partials.form_prices', ['product' => null])
                </div>

            </div>

            <div class="text-center">
                <button type="submit" class="btn-green">
                    <i class="fa fa-save"></i>
                    Actualizar precios
                </button>
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop

