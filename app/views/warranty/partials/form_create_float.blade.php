<div title="Registrar garantía" id="dialogRegister" data-width="500">

    {{ Form::open(['route'=>'warranty.store', 'method'=>'post', 'novalidate', 'class'=>'form validate', 'files'=>'true']) }}
    @include('warranty.partials.form_create')
    <div class="row text-center">
        {{ Form::submit('Registrar') }}
        {{ Form::reset('Limpiar formulario') }}
    </div>
    {{ Form::close() }}

</div>