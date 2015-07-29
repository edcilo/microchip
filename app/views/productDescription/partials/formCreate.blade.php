<div class="col col100">
    <div class="flo col20 row left">
        {{ Form::label('category_id', 'Categoría: ') }}
        {{ Form::select('category_id', $category_list, (!is_null($desc)) ? $desc->category_id : null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('category_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('mark_id', 'Marca: ') }}
        {{ Form::select('mark_id', $mark_list, (!is_null($desc)) ? $desc->mark_id : null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('mark_id', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('model', 'Modelo: ') }}
        {{ Form::text('model', !is_null($desc) ? $desc->model : null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('model', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col40 row right text-center">
        {{ Form::label('have_series', '¿El producto cuenta con número de serie?') }} <br/>
        <div class="flo col50">
            {{ Form::radio('have_series', 1, (!is_null($desc)) ? $desc->have_series == 1: true) }} Si
        </div>
        <div class="flo col50">
            {{ Form::radio('have_series', 0, (!is_null($desc)) ? $desc->have_series == 0: false) }} No
        </div>
        <div class="flo col100 message-error">
            {{ $errors->first('have_series', '<span>:message</span>') }}
        </div>
    </div>
</div>

<div class="col col100">
    <div class="flo col20 row left">
        {{ Form::label('data_sheet', 'Ficha técnica: ', ['class'=>'label50']) }}
        @if ( isset($product) AND !empty($product->pDescription->data_sheet))
            <a href="{{ asset($product->pDescription->data_sheet) }}" download>
                <i class="fa fa-download"></i> Descargar
            </a>
        @endif
        {{ Form::file('data_sheet', ['class'=>'xb-input', 'title'=>'Este campo solo acepta archivos PDF, JPG, JPEG, PNG, GIF.', 'data-mimes'=>'pdf,jpg,jpeg,png,gif']) }}
        <div class="message-error">
            {{ $errors->first('data_sheet', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col10 row center">
        {{ Form::label('stock_min', 'Stock minimo: ') }} <br/>
        {{ Form::text('stock_min', !is_null($desc) ? $desc->stock_min : null, ['class'=>'text-right sm-input', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo debe tener un valor entero sin signo.']) }}
        <div class="message-error">
            {{ $errors->first('stock_min', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col10 row center">
        {{ Form::label('stock_max', 'Stock maximo: ') }} <br/>
        {{ Form::text('stock_max', !is_null($desc) ? $desc->stock_max : null, ['class'=>'text-right sm-input', 'data-integer-unsigned'=>'integer', 'title'=>'Este campo debe tener un valor entero sin signo.']) }}
        <div class="message-error">
            {{ $errors->first('stock_max', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('provider', 'Proveedor: ') }}
        {{ Form::text('provider', !is_null($desc) ? $desc->provider : null, ['class'=>'xb-input', 'autocomplete'=>'off', 'data-url'=>route('provider.search')]) }}
        <div class="cont-form-search">
            <div class="resultSearch globe-center hide" id="provider_search_and_add"></div>
        </div>
        <div class="message-error">
            {{ $errors->first('provider', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row center">
        {{ Form::label('provider_barcode', 'Código de barras de proveedor:') }} <br/>
        {{ Form::text('provider_barcode', !is_null($desc) ? $desc->provider_barcode : null, ['class'=>'xb-input']) }}
        <div class="message-error">
            {{ $errors->first('provider_barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col20 row right">
        {{ Form::label('provider_warranty', 'Garantía con el proveedor:') }} <br/>
        {{ Form::text('provider_warranty', !is_null($desc) ? $desc->provider_warranty : null, ['placeholder'=>'Número de días', 'class'=>'text-right', 'title'=>'Este campo debe contener un número entero positivo.', 'data-integer-unsigned'=>'integer']) }}
        <div class="message-error">
            {{ $errors->first('provider_warranty', '<span>:message</span>') }}
        </div>
    </div>
</div>

@include('product.partials.service_price_bar')