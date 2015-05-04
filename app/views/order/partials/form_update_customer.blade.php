@if( p(86) )

    {{ Form::model($sale, ['route'=>['order.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

    <div class="col col100">
        <div class="row flo col20 left">
            {{ Form::label('customer_id', 'Cliente: ') }} <br/>
            {{ Form::text('customer_id', null, ['data-required'=>'required', 'autofocus', 'title'=>'Este campo es obligatorio.']) }}
            <div class="message-error">
                {{ $errors->first('customer_id', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col20 center">
            {{ Form::label('advance', 'Anticipo ($): ') }} <br/>
            {{ Form::text('advance', null, ['class'=>'text-right', 'data-required'=>'required', 'data-numeric'=>'numeric', 'title'=>'Este campo es obligatorio y numerico.']) }}
            <div class="message-error">
                {{ $errors->first('advance', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col20 center">
            {{ Form::label('delivery_date', 'Fecha de entrega: ') }} <br/>
            {{ Form::input('date', 'delivery_date', null, ['class'=>'', 'data-required'=>'required', 'data-date'=>'date', 'title'=>'Este campo es obligatorio y debe ser una fecha.']) }}
            <div class="message-error">
                {{ $errors->first('delivery_date', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row flo col20 right">
            {{ Form::label('shipping_address', 'Dirección de entrega: ') }}
            {{ Form::textarea('shipping_address', null, ['class'=>'', 'rows'=>2, 'title'=>'Este campo es obligatorio.']) }}
            <div class="message-error">
                {{ $errors->first('shipping_address', '<span>:message</span>') }}
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

    <div class="row text-center">
        <button type="submit" class="btn-green">
            <i class="fa fa-save"></i>
            Guardar
        </button>
    </div>

    {{ Form::close() }}

@endif