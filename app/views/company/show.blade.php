@extends('layouts/layout_sist')

@section ('title') / {{ $company->name }} @stop

@section('scripts')@stop

@section ('content')

    <div class="col col100 block description-product">

        <div class="header">
            <h1>{{ $company->name }}</h1>

            @include('company.partials.btn_edit')
        </div>

        @include('company.partials.data')

    </div>

@stop
