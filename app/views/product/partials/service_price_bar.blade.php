<div class="subtitle col col100">

    <div class="flo col25 left">
        {{ Form::label('purchase_price', 'Precio inicial ($):') }}
        {{ Form::text('purchase_price', isset($desc) ? $desc->purchase_price : null, ['class'=>'sm-input text-right', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required', 'data-numeric'=>'numeric']) }}
        <div class="message-error">
            {{ $errors->first('purchase_price', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col30 center">
        {{ Form::label('utility', 'Porcentaje de utilidad:') }}
        {{ Form::text('utility', isset($product) ? $product->utility_1 : 100, ['class'=>'sm-input text-right', 'title'=>'Este campo solo acepta valores numericos', 'data-numeric'=>'numeric']) }}
        %
    </div>

    <div class="flo col25 center">
        {{ Form::label('desc', 'Reduccion del:') }}
        {{ Form::text('desc', isset($product) ? $product->utility_1 - $product->utility_2 : 10, ['class'=>'sm-input text-right', 'title'=>'Este campo solo acepta valores numericos', 'data-numeric'=>'numeric']) }}
        %
    </div>

    <div class="flo col20 right">
        <button type="button" id="generate_prices" class="btn-green">
            Generar precios
        </button>

        <button type="button" id="round_prices" class="btn-green" title="Redondear precios">
            <i class="fa fa-circle-thin"></i>
        </button>
    </div>

</div>