@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="flo col50">
        <a href="{{ route('pay.pending') }}" class="btn-red">
            <i class="fa fa-arrow-left"></i>
            Volver a la caja
        </a>
    </div>

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

                    <button type="submit" class="btn-blue form_confirm" data-confirm="vale_confirm">
                        <i class="fa fa-ticket"></i>
                        Generar vale por $ {{ $sale->user_total_pay_f }}
                    </button>

                    {{ Form::close() }}

                    <div class="confirm-dialog hide" title="Generar vale" id="vale_confirm" data-width="400">
                        <div class="mesasge text-center">
                            <p>¿Estas seguro de querer generar un vale para la venta <strong>{{ $sale->folio }}</strong>?</p>
                        </div>
                    </div>
                </div>

                <div class="flo col33 center">
                    @if($sale->customer->id != 1 AND $sale->customer->card_id != '' AND $sale->customer->expiration_date != 'Vencido')

                        {{ Form::open(['route'=>['pay.repayment.store', $sale->id, 'card']]) }}

                        <button type="submit" class="btn-blue form_confirm" data-confirm="card_confirm">
                            <i class="fa fa-credit-card"></i>
                            Agregar rembolso al monedero del cliente
                        </button>

                        {{ Form::close() }}

                        <div class="confirm-dialog hide" title="Monedero" id="card_confirm" data-width="400">
                            <div class="mesasge text-center">
                                <p>
                                    ¿Estas seguro de querer agregar el rembolso al
                                    monedero electrónico del cliente
                                    <strong><nobr>{{ $sale->customer->name }}</nobr></strong>?
                                </p>
                            </div>
                        </div>
                    @elseif($sale->customer->expiration_date == 'Vencido')
                        <span class="text-red">El monedero electrónico del cliente esta vencido</span>
                    @elseif($sale->customer->card_id == '')
                        <span class="text-red">El cliente no tiene monedero electrónico</span>
                    @else
                        &nbsp;
                    @endif
                </div>

                <div class="flo col33 right">

                    {{ Form::open(['route'=>['pay.repayment.store', $sale->id, 'repayment']]) }}

                    <button type="submit" class="btn-red form_confirm" data-confirm="cash_confirm">
                        Devolver $ {{ $sale->user_total_pay_f }} en efectivo
                    </button>

                    {{ Form::close() }}

                    <div class="confirm-dialog hide" title="Devolver efectivo" id="cash_confirm" data-width="400">
                        <div class="mesasge text-center">
                            <p>
                                ¿Estas seguro de querer devolver <strong>${{ $sale->user_total_pay_f }}</strong>
                                al cliente?
                            </p>
                        </div>
                    </div>

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
