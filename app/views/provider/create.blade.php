@extends('layouts/layout_sist')

@section ('title') / Registrar proveedor @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Registrar Proveedor</h2>
        </div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('provider.index') }}">
                <i class="fa fa-list"></i> Volver a la lista de proveedores
            </a>
        </div>

        <div class="flo col30 text-right">
            @include('provider.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Formulario de registro de proveedor</h2>

            {{ Form::open(['route'=>'provider.store', 'method'=>'post', 'role'=>'form', 'class'=>'form validate']) }}
            @include('provider.partials.form_create')

        </div>

    </div>

@stop