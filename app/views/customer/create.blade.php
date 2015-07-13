@extends ( 'layouts/layout_sist' )

@section ('title') / Registrar clientes @stop

@section('scripts')
    {{ HTML::script('js/search_customer.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-group"></i> Clientes</h2>
        </div>

        <div class="flo col40 text-right">
            @include('customer.partials.btn_index')
        </div>

        <div class="flo col30 text-right">
            @include('customer.partials.form_search')
        </div>
    </div>

    <div class="col col100">

        <div class="block description-product">

            <h2 class="header">Formulario de registro de cliente</h2>

            {{ Form::open(['route'=>'customer.store', 'method'=>'post', 'role'=>'form', 'class'=>'form validate']) }}
            @include('customer.partials.form_create')

        </div>

    </div>

@stop
