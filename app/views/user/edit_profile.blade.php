@extends('layouts/layout_sist')

@section ('title') / Editar perfil de usuario @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Editar perfil de usuario</h2>
        </div>

        <div class="flo col40 text-right">
            @include('user.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('user.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>Formulario de edición de perfil de {{ $profile->name }} {{ $profile->f_last_name }}</h1>

            @include('user.partials.btn_show')
        </div>

        <div class="flo col100">

            {{ Form::model($profile, ['route'=>['user.profile.update', $profile->id], 'method'=>'put', 'files'=>true, 'class' => 'form validate']) }}


            @include('user.partials.form_create_profile')

            <div class="row text-center">
                {{ Form::submit('Guardar cambios') }}
                {{ Form::reset('Limpiar formulario') }}
            </div>


            {{ Form::close() }}

        </div>

    </div>

@stop
