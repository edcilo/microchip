@extends ( 'layouts/layout_sist' )

@section ('title') / {{ $user->username }} @stop

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
            <h1>{{ $user->profile->full_name }}</h1>

            @include('user.partials.btn_edit')
        </div>

        @include('user.partials.data')

        <div class="col col100 text-right">
            <hr/>

            @include('user.partials.btn_trash_full')
        </div>

    </div>

    <div class="col col100">

        <div class="flo col50 left">
            @include('user.partials.data_hired')
        </div>

        <div class="flo col50 right">
            @include('user.partials.data_sales')
        </div>

    </div>

    @include('user.partials.list_permissions')

@stop
