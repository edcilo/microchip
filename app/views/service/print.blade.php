@extends('layouts/layout_sales')

@section ('title') / Servicio @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product left">

        <div class="subtitle">
            {{ $sale->classification }}
            ({{ $sale->status }})
        </div>

        <div class="col col100">
            <div class="flo col50">
                @include('sale.partials.btn_end')
            </div>

            <div class="flo col50 text-right">
                @include('service.partials.btn_print')
            </div>
        </div>

        @include('service.partials.header')

        @include('service.partials.data')

        <div class="col col100">
            @include('service.partials.list_movements')
        </div>

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
