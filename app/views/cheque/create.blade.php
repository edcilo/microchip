@extends('layouts/layout_sist')

@section('title') / Registrar cheques @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/cheques_script.js') }}
@stop

@section('content')

    <div class="col col100">
        <div class="flo col30">
            <h2>Cheques</h2>
        </div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('bank.show', [$bank->slug, $bank->id, 1]) }}">
                <i class="fa fa-list"></i> Volver a {{ $bank->name }}
            </a>
        </div>

        <div class="flo col30 text-right">
            @include('bank.partials.form_search')
        </div>
    </div>

<div class="col col100 block description-product">

    <h2 class="header">Registrar cheques de {{ $bank->name }}</h2>

    @include('cheque.partials.form_create')

</div>

@stop