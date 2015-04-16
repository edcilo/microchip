@extends('layouts/layout_sist')

@section ('title') / Pedidos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Pedido</h2>
        </div>

        <div class="flo col40 text-right">
            @include('order.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('order/partials/form_search')
        </div>
    </div>

    <div class="block description-product left">

        <div class="header">
            <h1>{{ $order->folio }}</h1>
            <span>{{ $order->status }}</span>

            @include('order.partials.btn_print')
        </div>

        @include('order.partials.data')

        <div class="text-right">

            @include('order.partials.form_sale')

        </div>

    </div>

    <div class="block description-product">

        <div class="subtitle">Productos</div>

        @include('order.partials.list_products_order')

    </div>

    @if( p(91) )

        <div class="block description-product">

            @include('order.partials.data_observations')

            <div class="subtitle">Bitácora</div>

            @include('order.partials.form_record')

            @include('order.partials.list_records')
        </div>

    @endif


    @if($order->price)
        <div class="col col100 block description-product edc-hide-show">

            <div class="subtitle">
                Datos de cotización
                <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
            </div>

            <div class="edc-hide-show-element">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Cost. unit.</th>
                        <th>Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->pas as $pa)
                        @if($pa->productPrice)
                            <tr>
                                <td class="text-right">{{ $pa->quantity_price }}</td>
                                <td>{{ $pa->barcode}}</td>
                                <td>{{ $pa->s_description }}</td>
                                <td class="text-right">$ {{ $pa->selling_price_f }}</td>
                                <td class="text-right">$ {{ $pa->total_f }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    @endif

@stop