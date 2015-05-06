{{ Form::open(['route'=>'user.store', 'method'=>'post', 'files'=>'true', 'class'=>'form validate', 'novalidate']) }}
<div class="col col100">

    @include('user.partials.form_create_user')

    @include('user.partials.form_create_profile')

    <div class="row text-center">
        <hr/>
        {{ Form::submit('Registrar') }}
        {{ Form::reset('Limpiar formulario') }}
    </div>

</div>

{{ Form::close() }}
