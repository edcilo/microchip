@extends('layouts/layout_sales')

@section ('title') / Ventas @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar numeros de serie</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            <a class="btn-blue" href="{{ route('sale.edit', [$sale->id]) }}">
                <i class="fa fa-eye"></i> Volver a la venta
            </a>
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Registrar numeros de serie de {{ $movement->product->barcode }}</h2>

            @if ( count($movement->series) != $movement->quantity )

                @include('series/partials/formSaleCreate')

            @endif


            @include('series/partials/createList')


        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop