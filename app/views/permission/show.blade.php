@extends('layouts/layout_sist')

@section ('title') / Permisos @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('permission.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('permission.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h2>{{ $permission->name }}</h2>

            @include('permission.partials.btn_edit')
        </div>

        <div class="flo col40 left">
            <ul class="list-description">
                <li>
                    <strong>Nombre de categoría: </strong> <br/>
                    {{ $permission->name }}
                </li>
            </ul>
        </div>

        <div class="flo col60 right">
            <ul class="list-description">
                <li>
                    <strong>Descripción: </strong> <br/>
                    {{ $permission->description }}
                </li>
            </ul>
        </div>

    </div>

    @include('permission.partials.list_users')

@stop
