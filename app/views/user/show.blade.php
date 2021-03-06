@extends ( 'layouts/layout_sist' )

@section ('title') / {{ $user->username }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
    {{ HTML::script('js/vendor/chart.js/Chart.min.js') }}

    <script>
        var data = {{ $data_chart }};
        // Get context with jQuery - using jQuery's .get() method.
        var ctx = $("#ChartUser").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var LineChart = new Chart(ctx).Line(data);
    </script>
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

        <hr>

        <div class="col col100">

            <div class="flo col50 left">
                @include('user.partials.form_destroy')
            </div>

            <div class="flo col50 right text-right">
                @include('user.partials.btn_trash_full')

                @include('user.partials.form_restore')
            </div>
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

    @include('user.partials.chart')

    @include('user.partials.list_permissions', ['permissions' => $user->permissions()->paginate()])

@stop
