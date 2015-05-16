@extends('layouts/layout_sist')

@section ('title') / Nota de crédito {{ $coupon->folio }} @stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('couponPurchase.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('couponPurchase.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $coupon->folio }}</h1>
        </div>

        <div class="col col100">
            <div class="flo col33 left">
                <ul>
                    <li>
                        <strong>Disponible:</strong>
                        @if ($coupon->available)
                            <i class="fa fa-check"></i>
                        @else
                            <i class="fa fa-times"></i>
                        @endif
                    </li>
                    <li>
                        <strong>Valor: </strong>
                        $ {{ $coupon->value_f }}
                    </li>
                    <li>
                        <strong>Observaciones: </strong>
                        {{ $coupon->observations }}
                    </li>
                </ul>
            </div>

            <div class="flo col33 center">
                <ul>
                    <li>
                        <strong>Proveedor:</strong>
                        <a href="{{ route('provider.show', [$coupon->provider->slug, $coupon->provider->id]) }}">
                            {{ $coupon->provider->name }}
                        </a>
                    </li>
                    <li>
                        <strong>Adquirido en la garantía:</strong>
                        <a href="{{ route('warranty.show', $coupon->warranty->id) }}">
                            {{ $coupon->warranty->folio }}
                        </a>
                    </li>
                </ul>
            </div>

            @if (! $coupon->available)
                <div class="flo col33 right">
                    <ul>
                        <li>
                            <strong>Compra:</strong>
                            <a href="{{ route('purchase.show', [$coupon->pay->bill->folio, $coupon->pay->bill->id]) }}">
                                {{ $coupon->pay->bill->folio }}
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

    </div>

@stop
