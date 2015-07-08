@extends('layouts/layout_sales')

@section ('title') / Editar PA @stop

@section('scripts')
    {{ HTML::script('js/pas.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Editar PA</h2>
        </div>

        <div class="flo col40 text-right">&nbsp;</div>

        <div class="flo col30 text-right">

            @if($pa->sale->classification == 'Servicio')
                @if($pa->sale->data->status == 'Proceso')
                    <a class="btn-blue" href="{{ route('service.show', $pa->sale->id) }}">
                        <i class="fa fa-eye"></i> Volver al servicio
                    </a>
                @else
                    <a class="btn-blue" href="{{ route('service.edit', $pa->sale->id) }}">
                        <i class="fa fa-eye"></i> Volver al servicio
                    </a>
                @endif
            @elseif ($pa->sale->classification == 'Pedido')
                <a class="btn-blue" href="{{ route('order.edit', [$pa->sale->id]) }}">
                    <i class="fa fa-eye"></i> Volver al pedido
                </a>
            @else

                <a class="btn-blue" href="{{ route('sale.edit', [$pa->sale->id]) }}">
                    <i class="fa fa-eye"></i> Volver a la venta
                </a>

            @endif

        </div>
    </div>

    <div class="col col100 block description-product left">

        <div class="header">
            <h2>Modificar PA</h2>
        </div>

        {{ Form::model($pa, ['route'=>['pas.update', $pa->id], 'method'=>'put', 'class'=>'form validate']) }}
        @include('pa/partials/createForm', ['sale'=>$pa->sale])

    </div>


@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
