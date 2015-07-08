@extends('layouts/layout_sales')

@section ('title') / Cotización @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
    {{ HTML::script('js/search_customer.js') }}
    {{ HTML::script('js/sale.js') }}
@stop

@section ('content')

    <div class="col col100 left">

        @include('price.partials.data_sale')

        <div class="subtitle_mark">
            @if( !$sale->movements_end )

                {{ Form::open(['route'=>'pas.order.store', 'method'=>'post', 'class'=>'form validate']) }}
                @include('movement.partials.form_create_sale')

            @else

                <strong>Lista de productos</strong>

            @endif
        </div>

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
        <div class="col col100 left">

            <div class="subtitle_mark">
                <strong>Cliente</strong>
            </div>

            @include('price.partials.form_update_customer')

        </div>

        @if (p(64))
            <hr/>

            <a href="{{ route('customer.create.min') }}" class="btn-green open_new_window" target="_blank">
                <i class="fa fa-plus"></i>
                Registrar cliente
            </a>
        @endif
    @endif

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
