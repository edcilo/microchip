@extends('provider.layout_show')

@section('form_contact')

    <div class="flo col100 block description-product">
        <div class="subtitle">Editar contacto</div>
        {{ Form::model($contact, ['route'=>['providerContact.update', $contact->id], 'method'=>'put', 'class'=>'form validate']) }}
        @include('providerContact/partials/formCreate')
    </div>

@stop