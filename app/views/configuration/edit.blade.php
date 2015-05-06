@extends('layouts/layout_sist')

@section ('title') / Editar variables globales @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col60">
            <h2><i class="fa fa-globe"></i> Editar variables globales</h2>
        </div>

        <div class="flo col40 text-right">
            @include('configuration.partials.btn_index')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2>Modificar variables globales</h2>
            </div>

            {{ Form::model($configuration, ['route'=>['configuration.update', $configuration->id], 'method'=>'put', 'novalidate', 'class'=>'form validate']) }}
            @include('configuration/partials/formCreate')

        </div>

    </div>

@stop
