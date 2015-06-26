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
    {{ HTML::style('js/vendor/perfect-scrollbar/0.4.11/perfect-scrollbar.min.css') }}
</head>
<body>
    @include('layouts/partials/header')

    <aside class="msgs hide"></aside>

    <div class="load_edc hide"><div class="cle_bleu_load_10"></div></div>

    <section class="cont1440">
        <div class="col col100">
            <div class="flo col20" >
                @include('layouts/partials/nav_admin')
            </div>

            <div class="flo col80 cont_principal" id="col-der">

                @include('layouts.partials.messages')

                @yield('content')

            </div>
        </div>
    </section>

    @include('layouts/partials/footer')

    {{-- jquery v1.10.2 --}}
    {{ HTML::script('js/vendor/jquery/jquery-v1.10.2.js') }}
    {{ HTML::script('js/vendor/jquery-ui/jquery-ui.js') }}

    {{-- perfect-scrollbar --}}
    {{ HTML::script('js/vendor/perfect-scrollbar/0.4.11/perfect-scrollbar.min.js') }}


    {{-- edcilo v1.0.0 --}}
    {{ HTML::script('js/vendor/edcilo/1.0.0/edcilo.js') }}


    {{-- scripts globales --}}
    {{ HTML::script('js/main.js') }}

    {{-- scripts personalizados por paginas --}}
    @yield('scripts')

</body>
</html>
