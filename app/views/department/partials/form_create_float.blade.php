@if( p(21) )

    <div title="Registrar departamento" id="dialogRegister" data-width="500">

        {{ Form::open(['route'=>'department.store', 'method'=>'post', 'class'=>'form validate', 'novalidate']) }}
        @include('department.partials.form_create')

    </div>

    @endif
