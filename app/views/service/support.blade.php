@extends('layouts/layout_sist')

@section ('title') / Servicio @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col50">
            <h2>Subir productos a soporte.</h2>
        </div>

        <div class="flo col50 text-right">
            <a href="{{ route('service.show', [$order->order->id]) }}" class="btn-blue">
                <i class="fa fa-arrow-left"></i>
                Volver al servicio
            </a>
        </div>
    </div>

    <div class="col col100 block description-product">

        @if($order->admin_id)
            <div class="header">
                Bajar producto de soporte
            </div>

            <div class="subtitle">Escanee el código de barras de su tarjeta de empleado en el area que corresponda:</div>

            {{ Form::model($order, ['route'=>['order.product.permission.down', $order->id], 'method'=>'post', 'class'=>'form validate']) }}

            <div class="col col100 text-center">

                <div class="row flo col33 left">
                    {{ Form::label('user_id', 'Persona que surte:') }} <br/>
                    {{ Form::text('user_id', Auth::user()->profile->full_name, ['class'=>'xb-input', 'disabled']) }}
                </div>

                <div class="row flo col33 center">
                    {{ Form::label('admin_id', 'Persona que dio permiso:') }} <br/>
                    {{ Form::text('admin_name', $order->permission_admin->profile->full_name, ['class'=>'xb-input', 'disabled']) }}
                    <div class="message-error">
                        {{ $errors->first('admin_id', '<span>:message</span>') }}
                    </div>

                    {{ Form::label('admin_id_pass', 'Contraseña:') }} <br/>
                    {{ Form::password('admin_pass', ['class'=>'xb-input', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('admin_id_pass', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="row flo col33 right">
                    {{ Form::label('support_id', 'Persona que recibe:') }} <br/>
                    {{ Form::text('admin_name', $order->permission_support->profile->full_name, ['class'=>'xb-input', 'disabled']) }}
                    <div class="message-error">
                        {{ $errors->first('support_id', '<span>:message</span>') }}
                    </div>

                    {{ Form::label('support_id_pass', 'Contraseña:') }} <br/>
                    {{ Form::password('support_pass', ['class'=>'xb-input', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('support_id_pass', '<span>:message</span>') }}
                    </div>
                </div>

            </div>

            <hr/>

            <div class="col col100 text-center">

                <button type="submit" class="btn-green">
                    <i class="fa fa-lock"></i>
                    Otorgar permisos
                </button>

            </div>

            {{ Form::close() }}
        @else
            <div class="header">
                Otorgar permisos
            </div>

            <div class="subtitle">Escanee el código de barras de su tarjeta de empleado en el area que corresponda:</div>

            {{ Form::open(['route'=>['order.product.permission', $order->id], 'method'=>'post', 'class'=>'form validate']) }}

            <div class="col col100 text-center">

                <div class="row flo col33 left">
                    {{ Form::label('user_id', 'Persona que surte:') }} <br/>
                    {{ Form::text('user_id', Auth::user()->profile->full_name, ['disabled']) }}
                </div>

                <div class="row flo col33 center">
                    {{ Form::label('admin_pass', 'Persona que da permiso:') }} <br/>
                    {{ Form::password('admin_pass', ['data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('admin_pass', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="row flo col33 right">
                    {{ Form::label('support_pass', 'Persona que recibe:') }} <br/>
                    {{ Form::password('support_pass', ['data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('support_pass', '<span>:message</span>') }}
                    </div>
                </div>

            </div>

            <hr/>

            <div class="col col100 text-center">

                <button type="submit" class="btn-green">
                    <i class="fa fa-lock"></i>
                    Otorgar permisos
                </button>

            </div>

            {{ Form::close() }}
        @endif

    </div>

@stop
