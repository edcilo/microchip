@extends('layouts/layout_sist')

@section ('title') / {{ $series->ns }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col30 text-center">&nbsp;</div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('product.show', [$series->product->slug, $series->product->id]) }}">
                <i class="fa fa-eye"></i> Volver a {{ $series->product->barcode }}
            </a>
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $series->ns }}</h1>
        </div>

        <div class="col col100">

            <div class="flo col33 left">
                <ul class="list-description">
                    <li>
                        <strong>No. de serie</strong>
                        {{ $series->ns }}
                    </li>
                    <li>
                        <strong>Estado:</strong>
                        {{ $series->status }}
                    </li>
                    @if ( $series->status == 'Vendido' )
                        <li>
                            <strong>Fecha de venta:</strong>
                            {{ $series }}
                        </li>
                        <li>
                            <strong>Precio de venta</strong>
                            {{ $series }}
                        </li>
                    @endif
                    @if ( $series->status == 'Garantía' )
                        <li>
                            <strong>Fecha de entrada de garantía:</strong>
                            {{ $series->date_warranty }}
                        </li>
                    @endif
                </ul>
            </div>

            <div class="flo col33 center">

                <ul class="list-description">
                    <li>
                        <strong>Producto:</strong>
                        {{ $series->product->barcode }}
                    </li>
                    <li>
                        <strong>Descripción:</strong> <br/>
                        {{ $series->product->s_description }}
                    </li>
                    <li>
                        <a href="{{ route('product.show', [$series->product->slug, $series->product->id]) }}">Ver detalles</a>
                    </li>
                </ul>

            </div>

            <div class="flo col33 right">

                <ul class="list-description">
                    @if ( count($series->movement->purchases) > 0 )
                        <li>
                            <strong>Factura de compra:</strong>
                            {{ $series->movement->purchases[0]->folio }}
                        </li>
                        <li>
                            <strong>Proveedor:</strong>
                            {{ $series->movement->purchases[0]->provider->name }}
                        </li>
                        <li>
                            <strong>Fecha de factura:</strong>
                            {{ $series->movement->purchases[0]->date }}
                        </li>
                        <li>
                            <a href="{{ route('purchase.show', [$series->movement->purchases[0]->folio, $series->movement->purchases[0]->id]) }}">Ver detalles</a>
                        </li>
                    @endif
                    <li>
                        <strong>Número de serie agregado directamente al inventario.</strong>
                    </li>
                </ul>

            </div>

        </div>

    </div>


@stop