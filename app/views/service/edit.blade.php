@extends('layouts/layout_sales')

@section ('title') / Servicio @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/search_customer.js') }}
    {{ HTML::script('js/sale.js') }}
@stop

@section ('content')

    <div class="col col100 left">

        <div class="col col100">
            <div class="row flo col20">
                {{ $sale->classification }}
            </div>

            <div class="row flo col40">
                Cliente: <strong>{{ $sale->customer->name }}</strong>
            </div>

            <div class="row flo col20">
                I.V.A.: <strong id="value_iva">{{ $sale->iva }}</strong>
            </div>

            <div class="row flo col20 text-right">
                @include('service.partials.form_destroy')
            </div>
        </div>

        <div class="col col100">
            @if( $sale->data )

                @include('service.partials.data')

            @else
                {{ Form::open(['route'=>['service.data.store', $sale->id], 'method'=>'post', 'class'=>'form validate']) }}

                @include('service.partials.form_create_service_data')
            @endif
        </div>
    </div>

    @if( $sale->data )

        <div class="col col100 left">

            <div class="subtitle_mark">
                @if( !$sale->movements_end )

                    {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                    @include('movement.partials.form_create_sale')

                @else

                    <strong>Lista de productos</strong>

                @endif
            </div>

            @include('service.partials.list_movements')

            <div class="text-right">

                @if( $sale->movements_end )

                    @include('sale.partials.btn_start')

                @else

                    @include('sale.partials.btn_stop')

                @endif

            </div>

        </div>

        @if( $sale->movements_end )

            <div class="col col100 left">

                <div class="subtitle_mark">
                    <strong>Cliente</strong>
                </div>

                @include('service.partials.form_update_customer')

            </div>

        @endif

    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
