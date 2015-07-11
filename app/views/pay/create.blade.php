@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/pay.js') }}
@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100 block description-product left">

        <div class="header">
            <h3><strong>Pago a {{ $sale->classification }} {{ $sale->folio }}</strong></h3>
        </div>

        {{ Form::open(['route'=>['pay.store', $sale->id], 'method'=>'post', 'class'=>'form validate', 'id'=>'form_pay']) }}
        @include('pay.partials.form_create')

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('pay.partials.calculate')

        @include('pay.partials.vale')

        @include('layouts/partials/options')

    </div>

@stop
