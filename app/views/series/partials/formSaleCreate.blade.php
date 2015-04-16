{{ Form::open(['route'=>'series.sale.store', 'method'=>'post', 'class'=>'form validate']) }}

{{ Form::hidden('inventory_movement_id', $movement->id) }}

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