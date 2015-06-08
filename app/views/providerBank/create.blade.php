@extends('provider.layout_show')

@section('form_bank')

    <div class="col col100 block description-product text-right">
        <div class="subtitle text-left">Registrar nuevo banco</div>
        {{ Form::open(['route'=>'providerBank.store', 'method'=>'post', 'class'=>'form validate']) }}
        @include('providerBank/partials/formCreate')
    </div>

@stop
