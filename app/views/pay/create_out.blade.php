@extends('layouts/layout_sales')

@section ('title') / Pagos @stop

@section('scripts')@stop

@section ('content')

    @include('layouts.partials.messages')

    <div class="col col100 block description-product left">

        <div class="header">
            <h3><strong>Registrar salida</strong></h3>
        </div>

        {{ Form::open(['route'=>['pay.store.out'], 'method'=>'post', 'class'=>'form validate']) }}
        @include('pay.partials.form_create_out')

    </div>

@stop

@section ('options')

    <div class="col col100 right">

        @include('layouts/partials/options')

    </div>

@stop
