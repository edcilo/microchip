@extends('layouts/layout_sales')

@section ('title') / Ventas @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        @include('sale.partials.data_sale')

        @if( !$sale->movements_end )
            <div class="subtitle">

                {{ Form::open(['route'=>'movement.sale.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            </div>
        @endif

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
        <div class="col col100 block description-product">

            <div class="subtitle">
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