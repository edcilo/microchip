@extends('layouts/layout_sist')

@section ('title') / {{ $category->name }} @stop

@section('scripts')
    {{-- HTML::script('js/admin.js') --}}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('category.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('category.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $category->name }}</h1>

            @include('category.partials.btn_edit')
        </div>

        <div class="col col100">
            <figure class="flo col20 left">
                <img src="{{ asset($category->image) }}" alt="{{ $category->slug }}"/>
            </figure>

            <div class="flo col80 center">
                <ul class="list-description">
                    <li>
                        <strong>Nombre de categoría: </strong>
                        <ul>
                            <li>{{ $category->name }}</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Descripción: </strong>
                        <ul>
                            <li>{{ $category->description }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        @include('category.partials.form_destroy')

    </div>

    @include('category.partials.list_paginate_products')

@stop