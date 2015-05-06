@if( p(65) )
    <div title="Asignar monedero al cliente" id="dialogRegister" data-width="400">

        {{ Form::model($customer, ['route'=>['customer.card.update', $customer->id], 'method'=>'put', 'class'=>'form validate']) }}

        <div class="col col100">

            <div class="row">
                {{ Form::label('card_id', 'Número de monedero:') }}
                {{ Form::text('card_id', null, ['title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
            </div>

            <div class="row">
                {{ Form::label('expiration', 'Días de vigencia (0 para indefinido):') }}
                {{ Form::text('expiration', null, ['title'=>'Este campo acepta solo valores numericos.', 'data-integer-unsigned'=>'integer', 'class'=>'sm-input', 'autocomplete'=>'off']) }}
            </div>

            <hr/>

            <div class="text-center">
                {{ Form::submit('Guardar') }}
            </div>

        </div>

        {{ Form::close() }}

    </div>
@endif
