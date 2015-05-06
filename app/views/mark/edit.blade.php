@extends('layouts/layout_sist')

@section ('title') / Editar marca @stop

@section('scripts')@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Editar marca</h2>
    </div>

    <div class="flo col40 text-right">
        @include('mark.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('mark.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <div class="header">
            <h2>Formulario de edición de marca</h2>

            @include('mark.partials.btn_show')
        </div>

        {{ Form::model($mark, ['route'=>['mark.update', $mark->id], 'method'=>'put', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}

        @include('mark.partials.form_create')

        <div class="row text-center">
            <button class="btn-green" type="submit"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
            <a class="btn-red" href="{{ route('mark.show', [$mark->slug, $mark->id]) }}">Cancelar</a>
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop
