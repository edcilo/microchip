@extends('layouts/layout_sist')

@section ('title') / {{ $mark->name }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('mark.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('mark.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $mark->name }}</h1>

            @include('mark.partials.btn_edit')
        </div>

        <div class="col col100">
            <figure class="flo col20 left">
                <img src="{{ asset($mark->image) }}" alt="{{ $mark->slug }}"/>
            </figure>

            <div class="flo col80 center">
                <ul class="list-description">
                    <li>
                        <strong>Nombre de la marca: </strong>
                        <ul>
                            <li>{{ $mark->name }}</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Descripción: </strong>
                        <ul>
                            <li>{{ $mark->description }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        @include('mark.partials.form_destroy')

    </div>

    @include('mark.partials.data_products')

@stop
