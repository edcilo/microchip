@extends('provider.layout_show')

@section('form_phone')

    {{ Form::model($phone, ['route'=>['providerPhone.update', $phone->id], 'method'=>'put', 'class'=>'form validate']) }}
    @include('providerPhone/partials/formCreate')

@stop