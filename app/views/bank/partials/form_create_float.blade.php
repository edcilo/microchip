@if( p(6) )
    <div class="description-product" title="Registrar banco" id="dialogRegister" data-width="900">

        {{ Form::open(['route'=>'bank.store', 'method'=>'post', 'class'=>'form validate']) }}
        @include('bank/partials/form_create')

    </div>
@endif