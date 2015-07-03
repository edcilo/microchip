@extends('layouts/layout_sales')

@section ('title') / Pedido @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/search_customer.js') }}
    {{ HTML::script('js/sale.js') }}
@stop

@section ('content')

    <div class="col col100 left">

        @include('order.partials.data_order')

        <div class="subtitle_mark">
            @if( !$sale->movements_end )

                {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            @else

                <strong>Lista de productos</strong>

            @endif
        </div>

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
        <div class="col col100 left">

            <div class="subtitle_mark">
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
