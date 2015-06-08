@extends('provider.layout_show')

@section('form_contact')

    <div class="flo col100 block description-product">
        <div class="subtitle">Registrar nuevo contacto</div>
        {{ Form::open(['route'=>'providerContact.store', 'method'=>'post', 'class'=>'form validate']) }}
        @include('providerContact/partials/formCreate')
    </div>

@stop