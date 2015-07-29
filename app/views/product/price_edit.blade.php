@extends('layouts/layout_sist')

@section ('title') / Cambiar precios de {{ $product->type }} @stop

@section('scripts')
    {{ HTML::script('js/products.js') }}
    {{ HTML::script('js/search_provider.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col70">
            <h2><i class="fa fa-tag"></i> Cambiar precios de {{ $product->type }}</h2>
        </div>

        <div class="flo col40 text-right">
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

            <div class="col col100">

                <div class="flo col50 left">
                    <div class="subtitle_mark">
                        Precios actuales
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Utilidad</th>
                            <th>Precio</th>
                            <th>Precio I.V.A. (<span id="iva">{{ $iva }}</span> %)</th>
                            <th>Precio de oferta</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                        <tr>
                            <th>(1)</th>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_1 }}">
                                %
                            </td>
                            <td>
                                $
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->price_1 }}">
                            </td>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva1Attribute($iva) }}">
                            </td>
                            <td>
                                @if ($product->offer == 1) <i class="fa fa-check"></i> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>(2)</th>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_2 }}">
                                %
                            </td>
                            <td>
                                $
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->price_2 }}">
                            </td>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva2Attribute($iva) }}">
                            </td>
                            <td>
                                @if ($product->offer == 2) <i class="fa fa-check"></i> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>(3)</th>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_3 }}">
                                %
                            </td>
                            <td>
                                $
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->price_3 }}">
                            </td>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva3Attribute($iva) }}">
                            </td>
                            <td>
                                @if ($product->offer == 3) <i class="fa fa-check"></i> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>(4)</th>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_4 }}">
                                %
                            </td>
                            <td>
                                $
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->price_4 }}">
                            </td>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva4Attribute($iva) }}">
                            </td>
                            <td>
                                @if ($product->offer == 4) <i class="fa fa-check"></i> @endif
                            </td>
                        </tr>
                        <tr>
                            <th>(5)</th>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->utility_5 }}">
                                %
                            </td>
                            <td>
                                $
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->price_5 }}">
                            </td>
                            <td>
                                <input type="text" class="sm-input text-right" disabled value="{{ $product->getWithIva5Attribute($iva) }}">
                            </td>
                            <td>
                                @if ($product->offer == 5) <i class="fa fa-check"></i> @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flo col50 right">
                    <div class="subtitle_mark">
                        Precios sugeridos
                    </div>

                    @include('product.partials.form_prices')
                </div>

            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop

