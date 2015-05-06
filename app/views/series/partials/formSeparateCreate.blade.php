{{ Form::open(['route'=>'series.separated.store', 'method'=>'post', 'class'=>'form validate']) }}

{{ Form::hidden('order_product_id', $order->id) }}

<div class="message-error">
    {{ $errors->first('ns', '<span>:message</span>') }}
</div>
@for($i = 1; $i <= $order->quantity - count($order->series); $i++  )
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
