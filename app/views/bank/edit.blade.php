@extends('layouts/layout_sist')

@section('title') / Editar banco @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Editar banco</h2>
        </div>

        <div class="flo col40 text-right">
            @include('bank.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('bank.partials.form_search')
        </div>
    </div>

<div class="col col100 block description-product">

    <h2 class="header">Formulario de edición de {{ $bank->name }}</h2>

    {{ Form::model($bank, ['route'=>['bank.update', $bank->id], 'method'=>'put', 'class'=>'form validate']) }}
    @include('bank.partials.form_create')

</div>

@stop