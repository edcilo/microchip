@extends('layouts/layout_sist')

@section ('title') / Permisos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>
                <i class="fa fa-pencil"></i>
                Editar Permisos
            </h2>
        </div>

        <div class="flo col30 text-right">
            @include('permission.partials.btn_index')
        </div>

        <div class="flo col40 text-right">
            @include('permission.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h2>Modificar los datos de {{ $permission->name }}</h2>

            @include('permission.partials.btn_show')
        </div>

        {{ Form::model($permission, ['route'=>['permission.update', $permission->id], 'method'=>'put', 'class'=>'form validate']) }}
        @include('permission.partials.form_create')

    </div>

@stop
