@extends('provider.layout_show')

@section('form_phone')

    {{ Form::open(['route'=>'providerPhone.store', 'method'=>'post', 'class'=>'form validate']) }}
    @include('providerPhone/partials/formCreate')

@stop