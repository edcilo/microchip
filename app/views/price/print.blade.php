@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="subtitle">
            Cotización
            ({{ $price->status }})
        </div>

        <div class="col col100 text-right">
            <div class="flo col50 left text-left">
                <a href="{{ route('home.sale') }}" class="btn-red">
                    <i class="fa fa-times"></i>
                    Terminar
                </a>
            </div>

            <div class="flo col50 right text-right">
                <a class="btn-blue" title="Imprimir documento" target="_blank" href="{{ route('price.print.generate', [$price->folio, $price->id]) }}">
                    <i class="fa fa-print"></i>
                    Imprimir
                </a>
            </div>
        </div>

        @include('price/partials/header')

        <div class="col col100">
            @include('price/partials/tableProducts')
        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop