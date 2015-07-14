@extends('layouts/layout_sist')

@section ('title') / Venta {{ $sale->folio }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Venta</h2>
        </div>

        <div class="flo col40 text-right">
            @include('sale.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('sale.partials.form_search')
        </div>
    </div>

    <div class="block description-product">

        <div class="header">
            <h1>
                {{ $sale->type }}: {{ $sale->folio }}
                @if( $sale->new_price > 0 ) (Esta factura cuenta con un ajuste de precios) @endif
            </h1>

            <span>{{ $sale->status }}</span>
        </div>

        @include('sale.partials.data')

        <hr>

        <div class="col col100">
            <div class="flo col33">
                @include('sale.partials.form_cancel')
                &nbsp;
            </div>

            <div class="flo col33 center text-center">
                @include('sale.partials.btn_print_large')

                @include('sale.partials.btn_print')
            </div>

            <div class="flo col33 text-right">
                @include('sale.partials.btn_edit')
            </div>
        </div>

    </div>

    <div class="block description-product">

        <div class="subtitle">Productos</div>

        @include('sale.partials.list_products')

    </div>

    @include('sale.partials.warranties')

    @include('sale.partials.warranty_products')

    @include('sale.partials.form_adjust_price')

    @include('sale.partials.list_pay_pending')

    <div class="block description-product">

        <div class="subtitle">Pagos</div>

        @if(count($sale->payments))

            @include('sale.partials.list_pays')

            @include('pay.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay pagos registrados</p>

        @endif

    </div>


    @if($sale->price OR $sale->service)
        <div class="col col100 block description-product edc-hide-show">

            <div class="subtitle">
                Datos de cotización
                <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
            </div>

            <div class="edc-hide-show-element hide">

                @include('sale.partials.list_price')

            </div>

        </div>
    @endif

    @if($sale->separated OR $sale->service)
        <div class="col col100 block description-product edc-hide-show">

            <div class="subtitle">
                Datos de pedido
                <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
            </div>

            <div class="edc-hide-show-element hide">

                @include('sale.partials.data_order')

            </div>

        </div>

        <div class="col col100 block description-product edc-hide-show">

            <div class="subtitle">
                Bitácora
                <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
            </div>

            <div class="edc-hide-show-element hide">

                @include('sale.partials.list_records')

            </div>

        </div>
    @endif

@stop
