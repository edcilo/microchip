@extends('layouts/layout_sist')

@section('title') / {{ $pa->barcode }} @stop

@section('scripts')
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Porducto ordenado</h2>
        </div>

        <div class="flo col40 text-right">
            @include('pa.partials.btn_document')
        </div>

        <div class="flo col30 text-right">
            @include('pa.partials.btn_index')

            @include('pa/partials/form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $pa->barcode }} ({{ $pa->status }})</h1>
        </div>

        <div class="col col100">

            <figure class="flo col20 left">
                @if($pa->registered)
                    <img src="{{ asset($pa->product->image) }}" alt="{{ $pa->barcode }}"/>
                @elseif($pa->image_link == 'images/product/default.png')
                    <img src="{{ asset($pa->image_link) }}" alt="{{ $pa->barcode }}"/>
                @else
                    <img src="{{ $pa->image_link }}" alt="{{ $pa->barcode }}"/>
                @endif

                @if(!$pa->registered)
                    <p>
                        <strong>
                            <a href="{{ $pa->provider_link }}" target="_blank">
                                <i class="fa fa-link"></i>
                                Enlace con el proveedor
                            </a>
                        </strong>
                    </p>
                @endif
            </figure>

            <div class="flo col80 right">
                <div class="col col100 row">
                    <div class="flo col20 left">
                        <strong>Folio de documento:</strong> <br/>
                        {{ $pa->sale->folio }}
                    </div>

                    <div class="flo col20 center">
                        <strong>Codigo de barras:</strong> <br/>
                        @if($pa->registered)
                        <a href="{{ route('product.show', [$pa->barcode, $pa->product_id]) }}">
                            {{ $pa->barcode }}
                        </a>
                        @else
                            {{ $pa->barcode }}
                        @endif
                    </div>

                    <div class="flo col20">
                        <strong>Cantidad:</strong> <br/>
                        {{ $pa->quantity }}
                    </div>

                    <div class="flo col20">
                        <strong>Precio de venta:</strong> <br/>
                        $ {{ $pa->total_f }}
                    </div>

                    @if(!$pa->registered)
                        <div class="flo col20">
                            <strong>Costo de envio:</strong> <br/>
                            $ {{ $pa->shipping }}
                        </div>
                    @endif
                </div>

                <div class="col col100 row">
                    <div class="flo col30 left">
                        <strong>Descripción corta:</strong> <br/>
                        {{ $pa->s_description }}
                    </div>

                    <div class="flo col70 right">
                        <strong>Descripción larga</strong> <br/>
                        @if($pa->registered)
                            {{ $pa->product->description }}
                        @else
                            {{ $pa->l_description }}
                        @endif
                    </div>
                </div>

                <div class="col col100 row">
                    <div class="flo col30 left">
                        <strong>Surtidos:</strong>
                        {{ $pa->orders_total }}
                    </div>

                    <div class="flo col30 center">
                        <strong>Faltan por surtir:</strong>
                        {{ $pa->orders_rest }}
                    </div>
                </div>
            </div>

        </div>

    </div>

    @if($pa->status != 'Surtido' AND $pa->sale->status != 'Cancelado' AND ( p(112) OR  p(90) OR p(102) ) )
        <div class="col col100 block description-product">
            <h3 class="header">Archivar PA</h3>

            @include('pa.partials.form_supply')
        </div>
    @endif

    @if(count($pa->orders))
        @foreach($pa->orders as $order)
            <div class="col col100 block description-product">
                <h3 class="header">Sustituido por:</h3>

                @include('pa.partials.data_supply')

                @include('pa.partials.form_cancel')

            </div>
        @endforeach
    @endif

@stop
