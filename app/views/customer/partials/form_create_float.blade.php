@if( p(64) )

    <div title="Registrar cliente" id="dialogRegister" data-width="900">

        {{ Form::open(['route'=>'customer.store', 'method'=>'post', 'role'=>'form', 'class'=>'form validate']) }}
        @include('customer.partials.form_create')

    </div>

    @endif
