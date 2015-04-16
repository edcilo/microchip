@extends('layouts/layout_sales')

@section ('title') / Pedido @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        @include('order.partials.data_order')

        @if( !$sale->movements_end )
            <div class="subtitle">

                {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            </div>
        @endif

        @if ( count($sale->movements) OR count($sale->pas) )

            @include('order.partials.list_movements')

            <div class="text-right">

                @if( $sale->movements_end )

                    @include('sale.partials.btn_start')

                @else

                    @include('sale.partials.btn_stop')

                @endif

            </div>

        @endif

    </div>

    @if ( $sale->movements_end )
        <div class="col col100 block description-product">

            <div class="subtitle">
                <strong>Cliente</strong>
            </div>

            @include('order.partials.form_update_customer')

        </div>
    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop