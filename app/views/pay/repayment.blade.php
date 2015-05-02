@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100 block description-product left">

        <div class="header">
            <h3><strong>Devolución a {{ $sale->classification }} {{ $sale->folio }}</strong></h3>
        </div>

        <div class="form">
            <div class="row">
                <strong class="label50">Cliente:</strong>
                {{ $sale->customer->name }}
            </div>
            <div class="row">
                <strong class="label50">Total:</strong>
                @if($sale->classification == 'Servicio')
                    $ {{ $sale->total_price_f }}
                @elseif($sale->classification == 'Pedido')
                    $ {{ $sale->total_order_f }}
                @else
                    @if( $sale->new_price > 0 )
                        $ {{ $sale->pv_di_f }} =
                        [$ {{ $sale->total_f }} + $ {{ $sale->difference_iva }}]
                    @else
                        $ {{ $sale->total_f }}
                    @endif
                @endif
            </div>
            <div class="row">
                <strong class="label50">Saldo del cliente:</strong>
                $ {{ $sale->user_total_pay_f }}
            </div>
        </div>

        @if( !$sale->repayment )
            <div class="row text-center">

                <div class="flo col33 left">
                    {{ Form::open(['route'=>['pay.repayment.store', $sale->id, 'coupon']]) }}

                    <button type="submit" class="btn-blue">
                        <i class="fa fa-ticket"></i>
                        Generar vale por $ {{ $sale->user_total_pay_f }}
                    </button>

                    {{ Form::close() }}
                </div>

                <div class="flo col33 center">
                    @if($sale->customer->id != 1)

                        {{ Form::open(['route'=>['pay.repayment.store', $sale->id, 'card']]) }}

                        <button type="submit" class="btn-blue">
                            <i class="fa fa-credit-card"></i>
                            Agregar rembolso al monedero del cliente
                        </button>

                        {{ Form::close() }}

                    @else
                        &nbsp;
                    @endif
                </div>

                <div class="flo col33 right">

                    {{ Form::open(['route'=>['pay.repayment.store', $sale->id, 'repayment']]) }}

                    <button type="submit" class="btn-red">
                        Devolver $ {{ $sale->user_total_pay_f }} en efectivo
                    </button>

                    {{ Form::close() }}

                </div>

            </div>
        @else
            <div class="flo col50 left">
                <a href="{{ route('pay.pending') }}" class="btn-red">
                    <i class="fa fa-arrow-left"></i>
                    Terminar
                </a>
            </div>

            <div class="flo col50 right text-right">
                @if($sale->coupon)
                    <a href="{{ route('coupon.print', [$sale->coupon->id]) }}" class="btn-blue" target="_blank">
                        <i class="fa fa-print"></i>
                        <i class="fa fa-ticket"></i>
                        Imprimir vale
                    </a>
                @else
                    <a href="{{ route('pay.repayment.print', [$sale->id]) }}" class="btn-blue" target="_blank">
                        <i class="fa fa-print"></i>
                        Imprimir recibo
                    </a>
                @endif
            </div>
        @endif

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop