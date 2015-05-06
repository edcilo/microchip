@if( p(69) )

    {{ Form::model($referenced, ['route'=>['referrer.update', $referenced->id], 'method'=>'put', 'class'=>'form validate']) }}
    {{ Form::text('expiration', null, ['placeholder'=>'Días de vigencía', 'title'=>'Este campo solo acepta valores numericos', 'data-integer-unsigned'=>'integer', 'class'=>'xs-input text-right']) }}
    <button type="submit" class="btn-green" title="Activar referrenciado"><i class="fa fa-refresh"></i></button>
    {{ Form::close() }}

@else

    {{ $referenced->expiration }} días.

@endif
