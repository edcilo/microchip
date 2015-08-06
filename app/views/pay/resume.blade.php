@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100 block description-product left">

        <div class="header">
            <h3><strong>Pago a {{ $sale->classification }} {{ $sale->folio }}</strong></h3>
        </div>

        @if(count($sale->payments))

            @include('sale.partials.list_pays')

            @include('pay.partials.form_destroy_float')

        @else

            <p class="title-clear">No hay pagos registrados</p>

        @endif

        <div class="col col100">
            <div class="flo col50 left">
                @include('pay.partials.btn_back_pending')
            </div>

            <div class="flo col50 right text-right">
                @if($sale->status == 'Emitido')
                    @include('pay.partials.btn_pay')
                
                @endif
            </div>
        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
