@extends('layouts/layout_sist')

@section ('title') / Vale {{ $coupon->folio }} @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('coupon.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('coupon.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>Vale {{ $coupon->folio }}</h1>

            @include('coupon.partials.btn_print')
        </div>

        <div class="col col100">

            <div class="flo col33 left">

                <ul class="list-description">
                    <li>
                        <strong>Folio:</strong>
                        {{ $coupon->folio }}
                    </li>
                    <li>
                        <strong>Valor:</strong>
                        $ {{ $coupon->value_f }}
                    </li>
                    <li>
                        <strong>Pendiente:</strong>
                        @if( $coupon->available )
                            <i class="fa fa-check"></i>
                        @else
                            <i class="fa fa-times" title="Pagado"></i>
                        @endif
                    </li>
                    <li>
                        <strong>Fecha de vencimiento:</strong>
                        @if($coupon->last_date)
                            {{ $coupon->last_date }}
                        @else
                            Indefinido
                        @endif
                    </li>
                    <li>
                        <strong>Emitido por:</strong>
                        {{ $coupon->user->profile->full_name }}
                    </li>
                </ul>

            </div>
            <div class="flo col33 center">

                <ul class="list-description">
                    <li>
                        <strong>Documento:</strong>
                        {{ $coupon->sale->classification }}
                    </li>
                    <li>
                        <strong>Folio:</strong>
                        <a href="
                            @if($coupon->sale->classification == 'Venta')
                                {{ route('sale.show', $coupon->sale->id) }}
                            @elseif($coupon->sale->classification == 'Pedido')
                                {{ route('order.show', $coupon->sale->id) }}
                            @else
                                {{ route('service.show', $coupon->sale->id) }}
                            @endif
                                ">
                            {{ $coupon->sale->folio }}
                        </a>
                    </li>
                </ul>

            </div>
            <div class="flo col33 right">

                <ul class="list-description">
                    <li>
                        <strong>Cliente:</strong>
                        <a href="{{ route('customer.show', [$coupon->customer->slug, $coupon->customer_id]) }}">
                            {{ $coupon->customer->name }}
                        </a>
                    </li>
                </ul>

            </div>

        </div>

        @include('coupon.partials.form_destroy')

    </div>

@stop