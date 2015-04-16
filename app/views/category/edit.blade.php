@extends('layouts/layout_sist')

@section ('title') / Editar categoría @stop

@section('scripts')@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Editar categoría</h2>
    </div>

    <div class="flo col40 text-right">
        @include('category.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('category.partials.form_search')
    </div>
</div>

<div class="col col100">

    <div class="block description-product">

        <div class="header">
            <h2>Formulario de edición de categoría</h2>

            @include('category.partials.btn_show')
        </div>

        {{ Form::model($category, ['route'=>['category.update', $category->id], 'method'=>'put', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('category.partials.form_create')

        <div class="row text-center">
            <button class="btn-green" type="submit"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
            <a class="btn-red" href="{{ route('category.show', [$category->slug, $category->id]) }}">Cancelar</a>
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop