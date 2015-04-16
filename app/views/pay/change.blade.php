@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100 block description-product left">

        <div class="header">
            <h3><strong>Recibir cambio</strong></h3>
        </div>

        {{ Form::model($pay, ['route'=>['pay.change.in', $pay->id], 'method'=>'put', 'class'=>'form validate']) }}
        @include('pay.partials.form_change_in')

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop