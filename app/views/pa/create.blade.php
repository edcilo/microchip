@extends('layouts/layout_sales')

@section ('title') / Ventas @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar PA</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">

            @if($sale->classification == 'Servicio')
                @if($sale->data->status == 'Proceso')
                    <a class="btn-blue" href="{{ route('service.show', [$sale->folio, $sale->id]) }}">
                        <i class="fa fa-eye"></i> Volver al servicio
                    </a>
                @else

                    <a class="btn-blue" href="{{ route('sale.edit', [$sale->id]) }}">
                        <i class="fa fa-eye"></i> Volver a la venta
                    </a>

                @endif
            @else

                <a class="btn-blue" href="{{ route('sale.edit', [$sale->id]) }}">
                    <i class="fa fa-eye"></i> Volver a la venta
                </a>

            @endif
        </div>
    </div>

    <div class="col col100 block description-product left">

        <div class="header">
            <h2>Registrar nuevo PA</h2>
        </div>

        {{ Form::open(['route'=>'pas.store', 'method'=>'post', 'class'=>'form validate']) }}
        @include('pa/partials/createForm')

    </div>


@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop