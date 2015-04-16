@extends('layouts/layout_sales')

@section ('title') / Pedidos @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Pedido {{ $order->order->folio }}</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">
            @if( $order->order->classification == 'Servicio' )
                <a class="btn-blue" href="{{ route('service.show', [$order->order->folio, $order->order->id]) }}">
                    <i class="fa fa-eye"></i> Volver al servicio
                </a>
            @else
                <a class="btn-blue" href="{{ route('order.show', [$order->order->folio, $order->order->id]) }}">
                    <i class="fa fa-eye"></i> Volver al pedido
                </a>
            @endif
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Registrar numeros de serie de {{ $order->product->barcode }}</h2>

            @if ( count($order->series) != $order->quantity )

                @include('series/partials/formSeparateCreate')

            @endif

            @include('series/partials/createListSeparate')

        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop