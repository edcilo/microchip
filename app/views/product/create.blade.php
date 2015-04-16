@extends('layouts/layout_sist')

@section ('title') / Registrar {{ $s_type }} @stop

@section('scripts')@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-circle"></i> {{ $s_type }}</h2>
    </div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('product.index.' . $type) }}">
            <i class="fa fa-list"></i> Volver a la lista de {{ $s_type }}
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('product.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <h2 class="header">Formulario de registro de {{ $s_type }}</h2>

        {{ Form::open(['route'=>'product.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('product.partials.form_create')

    </div>

</div>

@stop