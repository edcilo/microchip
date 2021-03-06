@extends('layouts/layout_sist')

@section ('title') / Servicio @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/sale.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Servicio</h2>
        </div>

        <div class="flo col40 text-right">
            @include('service.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('service.partials.form_search')
        </div>
    </div>

    @if($sale->trash)
        <aside class="msg_dialog">
            <i class="fa fa-trash"></i>
            Servicio descartado
        </aside>
    @endif

    <div class="col col100 block description-product left">

        <div class="header">
            <h1>
                Folio: {{ $sale->folio }}
                <small>({{ $sale->status }})</small>
            </h1>
        </div>

        @include('service/partials/header')

        <hr>

        <div class="text-right">
            @include('service.partials.btn_print_large')

            @include('service.partials.btn_print')
        </div>

    </div>


    <div class="block description-product">

        <div class="subtitle">Producto recibido</div>

        @include('service.partials.data_internal')

    </div>

    @if( p(97) AND $sale->status != 'Cancelado' AND !$sale->trash )
        <div class="col col100 block description-product edc-hide-show">
            <div class="subtitle">
                Posponer fecha de entrega
                <button class="btn-close edc-hide-show-trigger" type="button"><i class="fa fa-plus"></i></button>
            </div>

            <div class="edc-hide-show-element">

                @include('service.partials.form_delivery_date')

            </div>
        </div>
    @endif

    @if( $sale->status != 'Cancelado' AND !$sale->trash )
        <div class="col col100">
            <div class="flo col50">
                @include('service.partials.form_cancel')
            </div>

            <div class="flo col50 text-right">

                @if($sale->data->status == 'Terminado')

                    @include('service.partials.form_restart')

                    @include('service.partials.form_sale')

                @else

                    @include('service.partials.form_finish')

                @endif

            </div>
        </div>
    @endif

    @include('service.partials.warranty_service')

    @include('service.partials.warranty_control')

    @include('service.partials.warranty_coupons')

    <div class="block description-product">
        <p class="subtitle">
            <strong>Cotizado</strong>
        </p>

        @if( p(95) AND $sale->status != 'Cancelado' AND !$sale->trash )
            <div class="subtitle">
                {{ Form::open(['route'=>['pas.order.store', $sale->id], 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')
            </div>
        @endif

        @include('service.partials.list_products')
    </div>

    <div class="block description-product">

        <div class="subtitle">
            Cargos y abonos
        </div>

        @include('sale.partials.list_pays')

        @include('pay.partials.form_destroy_float')

    </div>

    @if( p(91) )

        <div class="col col100">

            <div class="flo col70 left">

                <div class="block description-product">

                    <p class="subtitle">Bitácora:</p>

                    @include('service.partials.form_record')

                    @include('service.partials.list_records')

                </div>

            </div>

            <div class="flo col30 right">

                <div class="block description-product">

                    <p class="subtitle">Sugerencias</p>

                    @include('service.partials.list_suggestions')

                </div>

            </div>

        </div>

    @endif

    @include('service.partials.send_trash')

    @include('service.partials.restore')

@stop
