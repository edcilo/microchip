{{ Form::model($sale, ['route'=>['price.update', $sale->id], 'method'=>'put', 'class'=>'form validate']) }}

<div class="col col100">
    <div class="row flo col25 left">
        {{ Form::label('customer_id', 'Cliente: ') }} <br/>
        {{ Form::text('customer_id', null, ['data-required'=>'required', 'autofocus', 'title'=>'Este campo es obligatorio.']) }}
        <div class="message-error">
            {{ $errors->first('customer_id', '<span>:message</span>') }}
        </div>
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