@extends ( 'layouts/layout_sist' )

@section ('title') / Permisos de {{ $user->username }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">&nbsp;</div>

        <div class="flo col40 text-right">
            @include('user.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('user.partials.form_search')
        </div>
    </div>

    <div class="col col100 block description-product">

        <div class="header">
            <h1>Modificar permisos de {{ $user->profile->full_name }}</h1>

            @include('user.partials.btn_show')
        </div>

        @include('user.partials.data_min')

    </div>

    <div class="col col100">

        <div class="flo col50 left">

            @include('permission.partials.form_permissions_attach')

        </div>

        <div class="flo col50 right">

            @include('permission.partials.form_permissions_detach')

        </div>

    </div>

@stop