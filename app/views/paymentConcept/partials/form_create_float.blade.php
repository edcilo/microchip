@if( p(135) )


    <div title="Registrar concepto de gasto" id="dialogRegister" data-width="600">

        {{ Form::open(['route'=>'concept.store', 'method'=>'post', 'novalidate', 'class'=>'form validate']) }}
        @include('paymentConcept.partials.form_create')

        <div class="row text-center">
            {{ Form::submit('Registrar') }}
            {{ Form::reset('Limpiar formulario') }}
        </div>

        {{ Form::close() }}

    </div>

@endif
