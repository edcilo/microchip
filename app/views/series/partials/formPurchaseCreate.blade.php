@if( p(61) )
    {{ Form::open(['route'=>'series.purchase.store', 'method'=>'post', 'class'=>'form validate']) }}

        {{ Form::hidden('product_id', $product->id) }}
        {{ Form::hidden('inventory_movement_id', $movement->id) }}
        {{ Form::hidden('purchase_id', $purchase->id) }}

        <div class="message-error">
            {{ $errors->first('ns', '<span>:message</span>') }}
        </div>
        @for($i = 1; $i <= $movement->quantity - count($movement->series); $i++  )
            <div class="row text-center">
                {{ Form::label("ns_$i", "Numero de serie ($i): ") }}
                {{ Form::text('ns[]', null, ['id'=>'ns_'.$i, 'autofocus', 'title'=>'Este campo es obligatorio.', 'autocomplete'=>'off']) }}
            </div>
        @endfor

        <hr/>

        <div class="row text-center">
            {{ Form::submit('Guardar') }}
        </div>

    {{ Form::close() }}
@endif