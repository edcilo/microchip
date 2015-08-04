@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100">
        <div class="flo col25 left">
            @include('pay.partials.btn_big_print', ['pay' => $last_pay])
        </div>

        <div class="flo col75 right text-right">
            @include('pay.partials.btn_create_out')

            @include('pay.partials.btn_create_out_sale')

            @include('pay.partials.btn_create_in')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <strong>Ventas</strong>
        </div>

        @include('pay.partials.list_paginate_pending_pays')
    </div>

    @if(count($cancellations))
        <div class="col col100 block description-product">

            <div class="header">
                <strong>Cancelaciones</strong>
            </div>

            @include('pay.partials.list_paginate_cancellations')

        </div>
    @endif

    <div class="col col100 block description-product">
        <div class="header">
            <strong>Pedidos</strong>
        </div>

        @include('pay.partials.list_paginate_orders_pay')
    </div>

    <div class="col col100 block description-product">
        <div class="header">
            <strong>Servicios</strong>
        </div>

        @include('pay.partials.list_services_pay')
    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
