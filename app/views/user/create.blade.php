@extends ( 'layouts/layout_sist' )

@section ('title') / Registrar usuario @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-user"></i> Usuarios</h2>
    </div>

    <div class="flo col40 text-right">
        @include('user.partials.btn_index')
    </div>

    <div class="flo col30 text-right">
        @include('user.partials.form_search')
    </div>
</div>

<div class="col col100 block description-product">

    <h2 class="header">Formulario de registro de usuario</h2>

    @include('user.partials.form_create')

</div>

@stop