@extends ( 'layouts/layout_sist' )

@section ('title') / Editar departamento @stop

@section('scripts')
{{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">
        <h2><i class="fa fa-group"></i> Editar departamentos</h2>
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

<div class="col col100">

    <div class="block description-product">

        <div class="header">
            <h2>Formulario de edición de departamentos</h2>
            <a class="btn-blue" href="{{ route('department.show', [$department->slug, $department->id]) }}"><i class="fa fa-eye"></i></a>
        </div>

        {{ Form::model($department, ['route'=>['department.update', $department->id], 'method'=>'put', 'class'=>'form validate', 'novalidate']) }}
        @include('department.partials.form_create')

    </div>

</div>

@stop