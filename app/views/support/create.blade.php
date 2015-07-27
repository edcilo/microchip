@extends('layouts/layout_sist')

@section ('title') / Productos en soporte @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/search_product.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Registrar producto en soporte</h2>
        </div>

        <div class="flo col40 text-right">
            @include('support.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('support.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <h2 class="header">
            Formulario de registro
        </h2>

        {{ Form::open(['route'=>'support.store', 'class'=>'form validate']) }}

        @include('support.partials.form_create')

        <div class="row text-center">

            <button type="submit" class="btn-green">
                <i class="fa fa-save"></i>
                Guardar
            </button>

        </div>

        {{ Form::close() }}

    </div>

@stop
