@extends('layouts.layout_min')

@section('content')

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $product->barcode }}</h1>
        </div>

        <div class="col col00 form">

            <figure class="flo col40 left row">
                <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}"/>
            </figure>

            <div class="flo col60 right row">

                <div class="text-center">
                    <h2>{{ $product->s_description }}</h2>
                </div>

                <ul class="list-description">
                    @if ( is_object($product->p_description) )
                        <li>
                            <strong>Modelo:</strong>
                            {{ $product->p_description->model }}
                        </li>
                        <li>
                            <strong>Marca:</strong>
                            {{ $product->p_description->mark->name }}
                        </li>
                    @endif
                    <li>
                        <strong>Garantía:</strong>
                        {{ $product->warranty / 30 }} meses.
                    </li>
                    <li>
                        <strong>Descripción:</strong>
                        {{ $product->description }}
                    </li>
                    <li>
                        <strong>Precio regular (I.V.A. incluido):</strong>
                        $ {{ $product->price_1 }}
                    </li>
                    @if($product->offer > 1)
                        <li>
                            <strong>Precio de oferta (I.V.A. incluido):</strong>
                            $ {{ number_format($product->current_price * ($config->iva / 100 + 1), 2, '.', ',') }}
                        </li>
                    @endif
                </ul>
            </div>

        </div>

    </div>

@stop