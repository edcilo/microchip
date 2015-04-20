@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        @include('price.partials.data_sale')

        @if( !$sale->movements_end )
            <div class="subtitle">

                {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            </div>
        @endif

        @if ( count($sale->movements) OR count($sale->pas) )

            @include('price.partials.list_movements')

                <div class="col col100">
                    <div class="flo col50">
                        @include('price.partials.btn_clone')
                    </div>
                    <div class="flo col50 text-right">
                        @if( ! $sale->movements_end )

                            @include('sale.partials.btn_stop')

                        @else

                            @include('sale.partials.btn_start')

                        @endif
                    </div>
                </div>

        @endif

    </div>

    @if ( $sale->movements_end )
        <div class="col col100 block description-product">

            <div class="subtitle">
                <strong>Cliente</strong>
            </div>

            @include('price.partials.form_update_customer')

        </div>
    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop