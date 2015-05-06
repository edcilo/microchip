@extends('layouts/layout_sist')

@section('title') / {{ $provider->name }} @stop

@section('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            <a class="btn-blue" href="{{ route('provider.index') }}"><i class="fa fa-list"></i> Volver a la lista de proveedores</a>
        </div>

        <div class="flo col30 text-right">
            @include('provider.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">
        <div class="header">
            <h1>{{ $provider->name }}</h1>
            @if( $provider->active == 1 )
                <a class="btn-yellow" href="{{ route('provider.edit', [$provider->slug, $provider->id]) }}"><i class="fa fa-pencil"></i></a>
            @endif
        </div>

        <div class="col col100 form">

            <div class="flo col50 left row">
                <fieldset>
                    <legend>Inf. del proveedor</legend>
                    <ul class="list-description">
                        <li>
                            <strong>Nombre de la empresa:</strong>
                            {{ $provider->name }}
                        </li>
                        <li>
                            <strong>R.F.C.:</strong>
                            {{ $provider->rfc }}
                        </li>
                        <li>
                            <strong>Clasificación:</strong>
                            {{ $provider->classification }}
                        </li>
                        <li>
                            <strong>Correo electrónico:</strong>
                            {{ $provider->email }}
                        </li>
                        <li>
                            <strong>Teléfono:</strong>
                            {{ $provider->number }}
                        </li>
                        @if ( is_object($provider->phones) )
                        <li>
                            <strong>Otros teléfonos:</strong>
                            <ul>
                                @foreach ( $provider->phones as $phone )
                                    <li class="col col100">
                                        <div class="flo col50">
                                            {{ $phone->phone }}
                                        </div>
                                        <div class="flo col50 text-right">
                                            <a href="{{ route('providerPhone.edit', [$phone->id, $provider->id]) }}" class="btn-yellow">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            {{ Form::open(['route'=>['providerPhone.destroy', $phone->id], 'method'=>'delete', 'class'=>'inline']) }}
                                            <button type="submit" class="btn-red"><i class="fa fa-times"></i></button>
                                            {{ Form::close() }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    </ul>
                    <div class="col col100 row text-right">
                        <a href="{{ route('providerPhone.create', [$provider->id]) }}" class="btn-green" title="Agregar teléfono">
                            <i class="fa fa-plus"></i> <i class="fa fa-phone"></i>
                        </a>
                    </div>
                </fieldset>
            </div>

            <div class="flo col50 right row">
                <fieldset>
                    <legend>Ubicación</legend>
                    <ul class="list-description">
                        <li>
                            <strong>Estado:</strong>
                            {{ $provider->state }}
                        </li>
                        <li>
                            <strong>Ciudad:</strong>
                            {{ $provider->city }}
                        </li>
                        <li>
                            <strong>Código Postal:</strong>
                            {{ $provider->postcode }}
                        </li>
                        <li>
                            <strong>Dirección:</strong>
                            {{ $provider->address }}
                        </li>
                        <li>
                            <strong>Dirección de garantías:</strong>
                            {{ $provider->address_warranty }}
                        </li>
                    </ul>
                </fieldset>
            </div>

            <div class="flo col50">
                <fieldset>
                    <legend>Observaciones</legend>
                    <div class="col col100">
                        <ul class="description-product">
                            <li>
                                <strong>Observaciones: </strong>
                                {{ $provider->observations }}
                            </li>
                        </ul>
                    </div>
                </fieldset>
            </div>

        </div>

        <div class="col col100 form">

            <fieldset>
                <legend>Inf. bancaria</legend>

                <div class="flo col70">
                    <ul class="description-product">
                        <li>
                            <strong>Días de credito:</strong>
                            {{ $provider->days_credit }}
                        </li>
                        <li>
                            <strong>Límite de credito:</strong>
                            $ {{ number_format( $provider->credit_limit, 2 ) }}
                        </li>
                    </ul>
                </div>
                <div class="flo col30 text-right">
                    <a href="{{ route('providerBank.create', [$provider->id]) }}" class="btn-green" title="Agregar banco">
                        <i class="fa fa-plus"></i> <i class="fa fa-bank"></i>
                    </a>
                </div>

                @if ( is_object( $provider->banks ) )
                    <hr/>
                    @foreach( $provider->banks as $bank )
                        <div class="flo col50 center">
                            <div class="block description-product">
                                <div class="row">
                                    <strong>Nombre del banco:</strong>
                                    {{ $bank->bank }}
                                </div>
                                <div class="row">
                                    <strong>Número de cuenta:</strong>
                                    {{ $bank->account }}
                                </div>
                                <div class="row">
                                    <strong>Plaza:</strong>
                                    {{ $bank->plaza }}
                                </div>
                                <div class="row">
                                    <strong>CLABE:</strong>
                                    {{ $bank->clabe }}
                                </div>
                                <div class="col col100 text-right">

                                    <a href="{{ route('providerBank.edit', [$bank->id, $provider->id]) }}" class="btn-yellow">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    {{ Form::open(['route'=>['providerBank.destroy', $bank->id], 'method'=>'delete', 'class'=>'inline']) }}
                                    <button type="submit" class="btn-red" title="Eliminar contacto">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    {{ Form::close() }}

                                </div>
                            </div>
                        </div>
                    @endforeach()
                @endif
            </fieldset>

        </div>

        <div class="flo col100 form">
                <fieldset>
                    <legend>Contactos</legend>

                    <div class="col col100 row text-right">
                        <a href="{{ route('providerContact.create', [$provider->id]) }}" class="btn-green" title="Agregar contacto">
                            <i class="fa fa-plus"></i> <i class="fa fa-user"></i>
                        </a>
                    </div>

                    @if ( is_object( $provider->contacts ) )
                        @foreach ( $provider->contacts as $contact )
                            <div class="flo col50 center">
                                <div class="block description-product">
                                    <div class="row">
                                        <strong>Nombre: </strong>
                                        {{ $contact->name }} {{ $contact->last_name }}
                                    </div>
                                    <div class="row">
                                        <strong>Puesto:</strong>
                                        {{ $contact->job }}
                                    </div>
                                    <div class="row">
                                        <strong>Teléfono:</strong>
                                        {{ $contact->phone }}
                                    </div>
                                    <div class="row">
                                        <strong>Correo electrónico:</strong>
                                        {{ $contact->email }}
                                    </div>
                                    <div class="col col100 text-right">

                                        <a href="{{ route('providerContact.edit', [$contact->id, $provider->id]) }}" class="btn-yellow">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        {{ Form::open(['route'=>['providerContact.destroy', $contact->id], 'method'=>'delete', 'class'=>'inline']) }}
                                        <button type="submit" class="btn-red" title="Eliminar contacto">
                                            <i class="fa fa-times"></i>
                                        </button>
                                        {{ Form::close() }}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </fieldset>
        </div>

        <div class="col col100 text-right">
            <hr/>
            <a href="{{ route('provider.soft.delete', [$provider->id]) }}" class="btn-red">
                <i class="fa fa-trash"></i> Enviar a la papelera.
            </a>
        </div>

    </div>

@stop
