@extends('layouts/layout_sist')

@section ('title') / Registrar numeros de serie para {{ $movement->id }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar numeros de serie</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            <a class="btn-blue" href="{{ route('movement.index') }}">
                <i class="fa fa-eye"></i> Volver a los movimientos de inventario
            </a>
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Registrar numeros de serie de {{ $movement->product->barcode }}</h2>

            @if ( count($movement->series) != $movement->quantity )

                @include('series/partials/formCreate')

            @endif


            @include('series/partials/createList')


        </div>

    </div>

@stop
