@extends('provider.layout_show')

@section('form_bank')

    <div class="col col100 block description-product text-right">
        <div class="subtitle text-left">Editar información del banco</div>
        {{ Form::model($bank, ['route'=>['providerBank.update', $bank->id], 'method'=>'put', 'class'=>'form validate']) }}
        @include('providerBank/partials/formCreate')
    </div>

@stop
