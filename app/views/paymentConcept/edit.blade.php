@extends('layouts/layout_sist')

@section ('title') / Editar concepto @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col40">
            <h2><i class="fa fa-tag"></i> Editar concepto de gasto</h2>
        </div>

        <div class="flo col30 text-right">
            @include('paymentConcept.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('paymentConcept.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <div class="header">
                <h2>Formulario de edición de concepto</h2>
            </div>

            {{ Form::model($concept, ['route'=>['concept.update', $concept->id], 'method'=>'put', 'novalidate', 'class'=>'form validate']) }}
            @include('paymentConcept.partials.form_create')

            <div class="row text-center">
                <button class="btn-green" type="submit"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
                <a class="btn-red" href="{{ route('concept.index') }}">Cancelar</a>
            </div>

            {{ Form::close() }}

        </div>

    </div>

@stop
