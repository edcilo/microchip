<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-COMPATIBLE" content="IE=edge"/>

    <title>Microchip @yield('title')</title>

    <meta name="description" content="Sistema de registro y control de ventas, apartados y creditos de Microchip"/>
    <meta name="author" content="@edcilo"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <link rel="shortcut icon" href="{{ asset('img/logoH.png') }}" />

    {{ HTML::style('css/microchip.css', ['media' => 'screen']) }}
    {{ HTML::style('css/fonts/font-awesome-4.3.0/css/font-awesome.min.css') }}
</head>
<body>
@include('layouts/partials/header_index')


<section class="cont1366">
    <div class="col col100 cont_principal" id="col-der">

        <div class="flo col25 left">&nbsp;</div>

        <div class="flo col50 description-product block">

            <div class="header">
                <h1>Iniciar sesión</h1>
            </div>

            @if( Session::has('login_error') )
                <div class="msg_dialog">
                    La clave no es valida
                </div>
            @endif

            {{ Form::open(['route'=>'auth.login', 'method'=>'post', 'class'=>'form']) }}

            <div class="row text-center">
                <i class="fa fa-key"></i>
                {{ Form::password('password', ['autofocus', 'placeholder'=>'Contraseña']) }}
            </div>

            <hr/>

            <div class="text-center">
                <button class="btn-green" type="submit">
                    <i class="fa fa-sign-in"></i>
                    Iniciar sesión
                </button>
            </div>

            {{ Form::close() }}
        </div>

    </div>
</section>

@include('layouts/partials/footer')

{{-- jquery v1.10.2 --}}
{{ HTML::script('js/vendor/jquery/jquery-v1.10.2.js') }}
{{ HTML::script('js/vendor/jquery-ui/jquery-ui.js') }}


{{-- edcilo v1.0.0 --}}
{{ HTML::script('js/vendor/edcilo/1.0.0/edcilo.js') }}


{{-- scripts globales --}}
<script src="{{ asset('js/main.js') }}"></script>

{{-- scripts personalizados por paginas --}}
@yield('scripts')

</body>
</html>