@if( p(65) )

    <hr/>

    {{ Form::open(['route'=>['customer.contact.store', $customer->id], 'method'=>'post', 'class'=>'form validate']) }}

    <div class="col col100">

        <div class="row text-center">

            {{ Form::text('contact_id', null, []) }}

            <button type="submit" class="btn-green" title="Agregar contacto">
                <i class="fa fa-plus"></i> Agregar
            </button>

            <div class="cont-form-search">
                <div class="resultSearch globe-left hide" id="result-search-contact"></div>
            </div>

            <div class="message-error">
                {{ $errors->first('contact_id', '<span>:message</span>') }}
            </div>

        </div>

    </div>

    {{ Form::close() }}

@endif
