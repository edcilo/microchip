@if( p(46) )


    <div title="Registrar categoría" id="dialogRegister" data-width="500">

        {{ Form::open(['route'=>'category.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
        @include('category.partials.form_create')

        <div class="row text-center">
            {{ Form::submit('Registrar') }}
            {{ Form::reset('Limpiar formulario') }}
        </div>

        {{ Form::close() }}

    </div>

    @endif