@extends('layouts/layout_sist')

@section ('title') / Recontratar usuario @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2>Recontratar usuario</h2>
    </div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('user.index') }}">
            <i class="fa fa-list"></i> Volver a la lista de usuarios
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('users/partials/formSearch')
    </div>
</div>

<div class="col col100 block description-product">

    <div class="header">
        <h1>Formulario de recontrato de usuario</h1>
        <a class="btn-blue" href="{{ route('user.show', [$user->slug, $user->id]) }}"><i class="fa fa-eye"></i></a>
    </div>

    <div class="flo col100">

        @include('users/partials/formHire')

    </div>

</div>

@stop