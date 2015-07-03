{{ Form::model($sale, ['route'=>['service.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

<div class="col col100">
    <div class="row flo col20 left">
        {{ Form::label('customer_id', 'Cliente: ') }} <br/>
        {{ Form::text('customer_id', null, ['class'=>'stopEnter nextInput', 'autocomplete'=>'off', 'autofocus', 'data-required'=>'required', 'title'=>'Este campo es obligatorio.', 'data-url'=>route('customer.search'), 'data-customer'=>route('api.customer.get', 'CUSTOMER_ID')]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="customer_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('customer_id', '<span>:message</span>') }}
        </div>
        <strong id="customer_name_selected">{{ $sale->customer->name }}</strong>
    </div>

    <div class="row flo col20 center">
        {{ Form::label('advance', 'Anticipo ($): ') }} <br/>
        {{ Form::text('advance', null, ['class'=>'text-right', 'data-required'=>'required', 'data-numeric'=>'numeric', 'title'=>'Este campo es obligatorio y numerico.']) }}
        <div class="message-error">
            {{ $errors->first('advance', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 center">

        {{ Form::label('delivery_date', 'Fecha de entrega:') }}
        {{ Form::input('date', 'delivery_date', null, ['class'=>'', 'data-required'=>'required']) }}

        <div class="message-error">
            {{ $errors->first('delivery_date', '<span>:message</span>') }}
        </div>

    </div>

    <div class="row flo col20 center">

        {{ Form::label('delivery_time', 'Hora de entrega:') }}
        {{ Form::text('delivery_time', null, ['class'=>'', 'data-required'=>'required']) }}

        <div class="message-error">
            {{ $errors->first('delivery_time', '<span>:message</span>') }}
        </div>

    </div>

    <div class="row flo col20 right">
        {{ Form::label('description', 'Observaciones:') }} <br/>
        {{ Form::textarea('description', null, ['class'=>'xb-input', 'rows'=>2]) }} <br/>
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100 text-center">
    <hr/>
    <button type="submit" class="btn-green">
        <i class="fa fa-save"></i>
        Guardar
    </button>
</div>

{{ Form::close() }}
