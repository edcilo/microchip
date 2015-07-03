@extends('layouts/layout_sist')

@section ('title') / Registrar numeros de serie para {{ $product->barcode }} @stop

@section('scripts')
    {{ HTML::script('js/add_series.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar numeros de serie</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            <a class="btn-blue" href="{{ route('purchase.show', [$purchase->folio, $purchase->id]) }}">
                <i class="fa fa-eye"></i> Volver a la factura de compra
            </a>
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2>Registrar numeros de serie de {{ $product->barcode }}</h2>

                @if (count($movement->series))
                    <a href="{{ route('series.purchase.print', $movement->id) }}" class="btn-blue" title="Imprimir todo" target="_blank">
                        <i class="fa fa-print"></i>
                    </a>
                @endif
            </div>

            @if ( count($movement->series) != $movement->quantity )

                <div class="col col100">
                    <div class="flo col80 left">
                        Formato de números de serie generados: <strong>[folio de compra].[número de proveedor].[numero de producto].[consecutivo]</strong>
                    </div>
                    <div class="flo col20 text-right">
                        <button type="button" class="btn-green" id="generator_button_series" data-folio="{{ $movement->purchases[0]->folio }}" data-provider="{{ $movement->purchases[0]->provider_id }}" data-model="{{ $movement->product->id }}">
                            <i class="fa fa-plus"></i>
                            Generar números de serie.
                        </button>
                    </div>
                </div>

                @include('series/partials/formPurchaseCreate')

            @endif


            @include('series/partials/createList')


        </div>

    </div>

@stop
