@extends('layouts/layout_sist')

@section ('title') / Editar proveedor @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-tag"></i> Editar Proveedor</h2>
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

            <div class="header">
                <h2>Formulario de edición de proveedor</h2>
                <a class="btn-blue" href="{{ route('provider.show', [$provider->slug, $provider->id]) }}">
                    <i class="fa fa-eye"></i>
                </a>
            </div>

            {{ Form::model($provider, ['route'=>['provider.update', $provider->id], 'method'=>'put', 'role'=>'form', 'class'=>'form validate']) }}
            @include('provider.partials.form_create')

        </div>

    </div>

@stop