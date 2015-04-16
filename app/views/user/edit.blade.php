@extends('layouts/layout_sist')

@section ('title') / Editar datos de usuario @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2>Editar datos de usuario</h2>
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
        <h1>Formulario de edición de {{ $user->username }}</h1>

        @include('user.partials.btn_show')
    </div>

    <div class="flo col100">

        {{ Form::model($user, ['route'=>['user.update', $user->id], 'method'=>'put', 'role'=>'form', 'class' => 'form validate']) }}

        @include('user.partials.form_create_user')

        <div class="text-center">
            <button class="btn-green" type="submit"><i class="fa fa-floppy-o"></i> Guardar cambios</button>
        </div>

        {{ Form::close() }}

    </div>

</div>

@stop