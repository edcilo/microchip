@extends ( 'layouts/layout_sist' )

@section ('title') / Editar cliente @stop

@section('scripts')
    {{ HTML::script('js/search_customer.js') }}
    {{ HTML::script('js/customer.js') }}
@stop

@section ('content')

    <div class="col col100">
        <div class="flo col30">
            <h2><i class="fa fa-group"></i> Editar cliente</h2>
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

            <div class="header">
                <h2>Formulario de edición de cliente</h2>

                @include('customer.partials.btn_show')
            </div>

            {{ Form::model($customer, ['route'=>['customer.update', $customer->id], 'method'=>'put', 'role'=>'form', 'class'=>'form validate']) }}
            @include('customer.partials.form_create')

        </div>

    </div>

@stop
