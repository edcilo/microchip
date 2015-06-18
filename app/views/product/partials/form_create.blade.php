{{ Form::hidden('type', $s_type) }}

<div class="col col100">

    <div class="flo col25 row left">
        {{ Form::label('barcode', 'Código de barras: ') }}
        {{ Form::text('barcode', null, ['class'=>'xb-input text-uppercase', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('barcode', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col75 row center">
        {{ Form::label('s_description', 'Descripción corta: ') }}
        {{ Form::text('s_description', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('s_description', '<span>:message</span>') }}
        </div>
    </div>

</div>

<div class="col col100">

    <div class="flo col25 row left">
        {{ Form::label('warranty', 'Días de garantía: ') }}
        {{ Form::text('warranty', null, ['class'=>'xb-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-integer-unsigned'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('warranty', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('points', 'Puntos por compra (%): ') }} <br/>
        {{ Form::text('points', null, ['class'=>'text-right sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('points', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row center">
        {{ Form::label('r_points', 'Puntos por referido (%): ') }} <br/>
        {{ Form::text('r_points', null, ['class'=>'text-right sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'integer', 'data-required'=>'required']) }}
        <div class="message-error">
            {{ $errors->first('r_points', '<span>:message</span>') }}
        </div>
    </div>

    <div class="flo col25 row right">
        {{ Form::label('web', '¿Publicar en la página web?') }} <br/>
        <div class="flo col50">
            {{ Form::radio('web', 1, true) }} Si
        </div>
        <div class="flo col50">
            {{ Form::radio('web', 0, false) }} No
        </div>
        <div class="flo col100 message-error">
            {{ $errors->first('web', '<span>:message</span>') }}
        </div>
    </div>

</div>

@if ($s_type == 'Producto')

    <hr/>

    @include('productDescription.partials.formCreate', ['desc' => (isset($product)) ? $product->pDescription : null])

    <hr/>

@endif

<div class="col col100">

    <div class="flo col70 row left">

        <div class="flo col50 row left">&nbsp;</div>

        <div class="flo col50 row right">

            <div class="flo col100">
                <div class="flo col50 row left">
                    {{ Form::label('price_1', 'Precio 1: ') }}
                    {{ Form::text('price_1', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_1', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col50 row right">Precio de oferta</div>
            </div>

            <div class="flo col100">
                <div class="flo col50 row left">
                    {{ Form::label('price_2', 'Precio 2: ') }}
                    {{ Form::text('price_2', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_2', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col50 row right">
                    {{ Form::radio('offer', 2, false) }}
                </div>
            </div>

            <div class="flo col100">
                <div class="flo col50 row left">
                    {{ Form::label('price_3', 'Precio 3: ') }}
                    {{ Form::text('price_3', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_3', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col50 row right">
                    {{ Form::radio('offer', 3, false) }}
                </div>
            </div>

            <div class="flo col100">
                <div class="flo col50 row left">
                    {{ Form::label('price_4', 'Precio 4: ') }}
                    {{ Form::text('price_4', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_4', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col50 row right">
                    {{ Form::radio('offer', 4, false) }}
                </div>
            </div>

            <div class="flo col100">
                <div class="flo col50 row left">
                    {{ Form::label('price_5', 'Precio 5: ') }}
                    {{ Form::text('price_5', null, ['class'=>'sm-input', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off', 'data-numeric'=>'numeric', 'data-required'=>'required']) }}
                    <div class="message-error">
                        {{ $errors->first('price_5', '<span>:message</span>') }}
                    </div>
                </div>

                <div class="flo col50 row right">
                    {{ Form::radio('offer', 5, false) }}
                </div>
            </div>

        </div>

    </div>

    <div class="flo col30 row right">

        <div class="row">
            @if ( isset($product) )
                <figure class="flo col25 left">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->barcode }}">
                </figure>
            @endif

            {{ Form::label('image', 'Imagen: ') }} <br/>
            {{ Form::file('image', ['data-mimes'=>'jpg,jpeg,png,gif', 'title'=>'Este campo debe contener archivos de tipo imagen (.jpg, .jpeg, .png, .gif)']) }}
            <div class="message-error">
                {{ $errors->first('image', '<span>:message</span>') }}
            </div>
        </div>

        <div class="row">
            {{ Form::label('description', 'Descripción larga: ', ['class'=>'label50']) }} <br/>
            {{ Form::textarea('description', null, ['rows'=>'6', 'class'=>'xb-input']) }}
            <div class="message-error">
                {{ $errors->first('description', '<span>:message</span>') }}
            </div>
        </div>
    </div>

</div>


<div class="row text-center">
    {{ Form::submit('Guardar') }}
    {{ Form::reset('Limpiar formulario') }}
</div>

{{ Form::close() }}
