@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Cotización {{ $price->order->folio }}</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            @if( $price->order->classification == 'Servicio' )
                <a class="btn-blue" href="{{ route('service.show', [$price->order->folio, $price->order->id]) }}">
                    <i class="fa fa-eye"></i> Volver al servicio
                </a>
            @else
                <a class="btn-blue" href="{{ route('price.show', [$price->order->folio, $price->order->id]) }}">
                    <i class="fa fa-eye"></i> Volver a la cotización
                </a>
            @endif
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Registrar numeros de serie de {{ $price->product->barcode }}</h2>

            @if ( count($price->series) != $price->quantity )

                @include('series/partials/formPriceCreate')

            @endif

            @include('series/partials/createListPrice')

        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop