{{ Form::model($sale, ['route'=>['price.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

<div class="col col100">
    <div class="row flo col25 left">
        {{ Form::label('customer_id', 'Cliente: ') }} <br/>
        {{ Form::text('customer_id', null, ['class'=>'stopEnter nextInput', 'autocomplete'=>'off', 'autofocus', 'data-required'=>'required', 'title'=>'Este campo es obligatorio.', 'data-url'=>route('customer.search')]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="customer_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('customer_id', '<span>:message</span>') }}
        </div>
        <strong id="customer_name_selected">{{ $sale->customer->name }}</strong>
    </div>

    <div class="row flo col25 center">
        {{ Form::label('description', 'Observaciones:') }} <br/>
        {{ Form::textarea('description', null, ['class'=>'xb-input', 'rows'=>3]) }} <br/>
        <div class="message-error">
            {{ $errors->first('description', '<span>:message</span>') }}
        </div>
    </div>

    <div class="row flo col25 right">
        <br/>
        <button type="submit" class="btn-green">
            <i class="fa fa-save"></i>
            Guardar
        </button>
    </div>
</div>

{{ Form::close() }}
