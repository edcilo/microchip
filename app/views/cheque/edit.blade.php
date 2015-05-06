@extends('layouts/layout_sist')

@section('title') / Editar cheque @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section('content')

<div class="col col100">
    <div class="flo col30">
        <h2>Editar cheque</h2>
    </div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('bank.show', [$cheque->bank->slug, $cheque->bank->id, 1]) }}">
            <i class="fa fa-list"></i> Volver a {{ $cheque->bank->name }}
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('bank.partials.form_search')
    </div>
</div>

<div class="col col100 block description-product">

    <h2 class="header">Formulario de edición de cheque {{ $cheque->folio }}</h2>

    {{ Form::model($cheque, ['route'=>['cheque.update', $cheque->id], 'method'=>'put', 'class'=>'form validate']) }}
    @include('cheque.partials.form_edit')

</div>

@stop
