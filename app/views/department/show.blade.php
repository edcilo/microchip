@extends ( 'layouts/layout_sist' )

@section ('title') / {{ $department->name }} @stop

@section('scripts')
    {{ HTML::script('js/admin.js') }}
@stop

@section ('content')

<div class="col col100">
    <div class="flo col30">&nbsp;</div>

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

    <div class="header">
        <h1>{{ $department->name }}</h1>
        <a class="btn-yellow" href="{{ route('department.edit', [$department->slug, $department->id]) }}"><i class="fa fa-pencil"></i></a>
    </div>

    <div class="col col100">
        <ul class="list-description">
            <li>
                <strong>Nombre: </strong>
                <ul>
                    <li>{{ $department->name }}</li>
                </ul>
            </li>
            <li>
                <strong>Descripción: </strong>
                <ul>
                    <li>{{ $department->description }}</li>
                </ul>
            </li>
        </ul>
    </div>

    @if ( count($department->users) == 0 )
        <hr/>

        {{ Form::open(['route'=>['department.destroy', $department->id], 'method'=>'delete', 'class'=>'form']) }}
            <div class="row text-right form_confirm" data-confirm="destroy_confirm">
                <button class="btn-red"><i class="fa fa-times"></i> Eliminar</button>
            </div>
        {{ Form::close() }}

        <div class="confirm-dialog hide" title="Eliminar departamento" id="destroy_confirm" data-width="400">
            <div class="mesasge text-center">
                <p>¿Estas seguro de querer eliminar al departamento <strong>{{ $department->name }}</strong>?</p>
            </div>
        </div>
    @endif


</div>

<div class="col col100 block description-product">

    <h3 class="subtitle">Personal de {{ $department->name }}</h3>

    @include('department.partials.list_paginate_users', ['users'=>$department->users()->paginate()])

</div>

@stop
