@extends('layouts/layout_sales')

@section ('title') / Servicio @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="col col100">
            <div class="row flo col20">
                {{ $sale->classification }}
            </div>

            <div class="row flo col40">
                Cliente: <strong>{{ $sale->customer->name }}</strong>
            </div>

            <div class="row flo col20">
                I.V.A.: <strong>{{ $sale->iva }}</strong>
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

        <div class="col col100 block description-product">

            @if( !$sale->movements_end )
                <div class="subtitle">

                    {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                    @include('movement.partials.form_create_sale')

                </div>
            @endif

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

            <div class="block description-product">

                <div class="subtitle">Cliente</div>

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