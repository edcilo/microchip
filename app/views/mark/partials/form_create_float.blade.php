@if( p(42) )

    <div title="Registrar marca" id="dialogRegister" data-width="500">

        {{ Form::open(['route'=>'mark.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('mark.partials.form_create')

        <div class="row text-center">
            {{ Form::submit('Registrar') }}
            {{ Form::reset('Limpiar formulario') }}
        </div>

        {{ Form::close() }}

    </div>

    @endif