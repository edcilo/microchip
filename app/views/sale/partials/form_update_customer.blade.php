@if( p(78) )

    {{ Form::model($sale, ['route'=>['sale.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

    <div class="row flo col30 left">
        {{ Form::label('type', 'Tipo de documento: ') }} <br/>
        {{ Form::select('type', $type_list, null, ['data-required'=>'required', 'autofocus', 'title'=>'Seleccione un campo valido de la lista.']) }}
        <div class="message-error">
            {{ $errors->first('type', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('customer_id', 'Cliente: ') }}
        <strong id="customer_name_selected">{{ $sale->customer->name }}</strong> <br/>
        {{ Form::text('customer_id', null, ['class'=>'text-right', 'autocomplete'=>'off', 'data-required'=>'required', 'title'=>'Este campo es obligatorio.', 'data-url'=>route('customer.search')]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="customer_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('customer_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('description', 'Observaciones:') }} <br/>
        {{ Form::textarea('description', null, ['class'=>'xb-input', 'rows'=>2]) }} <br/>
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col20 right text-right">
        <button type="submit" class="btn-green">
            <i class="fa fa-save"></i>
            Guardar y continuar
        </button>
    </div>

    {{ Form::close() }}

@endif
