@extends('layouts/layout_sales')

@section ('title') / Ventas @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/sale.js') }}
@stop

@section ('content')

    <div class="col col100 left">

        @include('sale.partials.data_sale')

        <div class="subtitle_mark">
            @if( !$sale->movements_end )

                {{ Form::open(['route'=>'movement.sale.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            @else

                <strong>Lista de productos</strong>

            @endif
        </div>

        @if ( count($sale->movements) OR count($sale->pas) )

            @include('sale.partials.list_movements')

            <div class="text-right">

                @if( ! $sale->movements_end AND $sale->series_end )

                    @include('sale.partials.btn_stop')

                @elseif( ! $sale->movements_end AND ! $sale->series_end )

                    <span class="text-red">Falta capturar números de serie...</span>

                @else

                    @include('sale.partials.btn_start')

                @endif

            </div>

        @endif

    </div>

    @if ( $sale->movements_end )
        <div class="col col100 left">

            <div class="subtitle_mark">
                <strong>Cliente</strong>
            </div>

            @include('sale.partials.form_update_customer')

        </div>
    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
