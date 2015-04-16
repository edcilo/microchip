@extends ( 'layouts/layout_sist' )

@section ('title') / Registrar departamento @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-tag"></i> Departamentos</h2>
    </div>

    <div class="flo col40 text-right">
        <a class="btn-blue" href="{{ route('department.index') }}">
            <i class="fa fa-list"></i> Volver a la lista de departamentos
        </a>
    </div>

    <div class="flo col30 text-right">
        @include('department.partials.form_search')
    </div>
</div>

<div class="col col100 block description-product">

    <h2 class="header">Formulario de registro de departamentos</h2>

    {{ Form::open(['route'=>'department.store', 'method'=>'post', 'class'=>'form validate', 'novalidate']) }}
    @include('department.partials.form_create')

</div>

@stop